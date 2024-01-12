<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Device;
use App\Models\Role;
use App\Models\Server;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Rules\NonUnique;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:255', new NonUnique],
            'country_code' => ['required', 'string', 'max:255'],
            'server' => ['required', 'string', 'max:255'],
            'device' => ['required', 'string', 'max:255'],
            'server' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $server = $data['server'];
        $application = $data['application'];
        $device = $data['device'];


        Server::updateOrInsert(['name' =>  $server]);
        Device::updateOrInsert(['name' =>  $device]);
        Application::updateOrInsert(['name' =>  $application]);

        $user =  User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'whatsapp' => $data['whatsapp'],
            'country_code' => $data['country_code'],
            'application' => $data['application'],
            'server' => $data['server'],
            'device' => $data['device'],
            'password' => Hash::make($data['password']),
        ]);


        $userRole = "reseller";

        // Assign role to the user
        $role = Role::where('name', $userRole)->first();

        if ($role) {
            $user->roles()->attach($role);
        } else {
            // Handle the case where the role doesn't exist
            // You might want to log an error or take appropriate action
            // For now, we'll just throw an exception
            throw new \Exception("Role not found: {$userRole}");
        }

        return $user;
    }
}
