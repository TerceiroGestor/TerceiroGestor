<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['id' => 55,  'name' => 'Brasil', 'region' => 'América do Sul']
        ];
        foreach ($countries  as $country) {
            Country::updateOrCreate(
                ['id' => $country['id']],
                [
                    'name' => $country['name'],
                    'region' => $country['region'],
                ]
            );
        }
    }
}
