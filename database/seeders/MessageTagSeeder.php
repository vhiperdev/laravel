<?php

namespace Database\Seeders;

use App\Models\MessageTag;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MessageTag::create(['tag' => '{NAME}']);
        MessageTag::create(['tag' => '{EXPIRY_DATE}']);
        MessageTag::create(['tag' => '{PROVIDER}']);
        MessageTag::create(['tag' => '{SCREEN}']);
        MessageTag::create(['tag' => '{DEVICE}']);
        MessageTag::create(['tag' => '{APPLICATION}']);
        MessageTag::create(['tag' => '{KEY}']);
        MessageTag::create(['tag' => '{MAC}']);
        MessageTag::create(['tag' => '{USERNAME}']);
        MessageTag::create(['tag' => '{WHATSAPP_NUMBER}']);
    }
}
