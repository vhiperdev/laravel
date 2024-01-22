<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\MessageTemplate;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Settings::with(['message_template', 'currencyDetails'])->first();
        $message_templates = MessageTemplate::all();
        $curencies = Currency::all();
        return view('settings.settings', compact('settings', 'curencies', 'message_templates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function profile()
    {
        $profile = Auth::user();
        return view('settings.profile', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function profileUpdate(Request $request)
    {   
         $user = User::findOrFail(auth()->user()->id);

         if ($request->old_password && $request->old_password !== '' && $request->old_password !== null) {
            $validator = Validator::make($request->all(), [
                'old_password' => 'required|string|min:6',
                'new_password' => 'required|string|min:6|different:old_password',
                'confirm_password' => 'required|string|min:6|same:new_password',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with(['error' => $validator->errors()->first()]);
            }

           
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->with(['error' => 'The old password is incorrect.']);
            }
        }


        try {  

            if ($request->new_password) {
                $user->password = Hash::make($request->new_password);
            }

            $user->name = $request->name;
            $user->save();

            return redirect()->back()->with('message', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $requestData = $request->except('_token');

            if ($request->file('site_logo')) {
                $image = $request->file('site_logo')->store('uploads/site_images', 'public');
                $requestData['site_logo'] =  asset('storage/' . $image);
            }


            if ($request->file('site_favicon')) {
                $image = $request->file('site_favicon')->store('uploads/site_images', 'public');
                $requestData['site_favicon'] =  asset('storage/' . $image);
            }

            Settings::updateOrInsert(
                ['id' => 1],
                $requestData      // Data to update or insert
            );

            return redirect()->back()->with('message', 'Settings saved successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
