<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::updateOrInsert(['name' => 'Dolar', 'code' => 'USD', 'symbol' => '$']);
        Currency::updateOrInsert(['name' => 'Brazilian Real', 'code' => 'BRL', 'symbol' => 'R$']);
    }
}
