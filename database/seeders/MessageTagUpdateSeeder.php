<?php

namespace Database\Seeders;

use App\Models\MessageTag;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageTagUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MessageTag::create(['tag' => '{PLAN_VALUE}']);
        MessageTag::create(['tag' => '{PLAN_NAME}']);
        MessageTag::create(['tag' => '{CURRENCY}']);
    }
}
