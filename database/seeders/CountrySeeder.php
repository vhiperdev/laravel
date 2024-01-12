<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    public function run()
    {
        DB::table('country')->insert([
            [
                'id' => 1,
                'Country Name' => 'Afghanistan',
                'ISO2' => 'AF',
                'ISO3' => 'AFG',
                'Top Level Domain' => 'af',
                'FIPS' => 'AF',
                'ISO Numeric' => 4,
                'GeoNameID' => '1149361',
                'E164' => 93,
                'Phone Code' => '93',
                'Continent' => 'Asia',
                'Capital' => 'Kabul',
                'Time Zone in Capital' => 'Asia/Kabul',
                'Currency' => 'Afghani',
                'Language Codes' => 'fa-AF,ps,uz-AF,tk',
                'Languages' => 'Afghan Persian or Dari (official) 50%, Pashto (official) 35%, Turkic languages (primarily Uzbek and Turkmen) 11%, 30 minor languages (primarily Balochi and Pashai) 4%, much bilingualism, but Dari functions as the lingua franca',
                'Area KM2' => 647500,
                'Internet Hosts' => '223',
                'Internet Users' => '1000000',
                'Phones (Mobile)' => '18000000',
                'Phones (Landline)' => '13500',
                'GDP' => '20650000000',
            ],
            // Add other countries here...
        ]);
    }
}
