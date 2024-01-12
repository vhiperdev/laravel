<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencyId = Currency::where('name', 'Dolar')->pluck('id')->first();
        Settings::updateOrInsert(['id' => 1], ['currency' => $currencyId]);
    }
}
