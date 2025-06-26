<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\City;
use App\Models\State;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = State::all();

        foreach ($states as $state) {
            $response = Http::withoutVerifying()
                ->get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$state->id}/municipios");

            if ($response->successful()) {
                foreach ($response->json() as $city) {
                    City::updateOrCreate(
                        ['id' => $city['id']], // ID do IBGE
                        [
                            'name' => $city['nome'],
                            'state_id' => $state->id
                        ]
                    );
                }

                echo "✅ Cidades do estado {$state->uf} importadas com sucesso.\n";
            } else {
                echo "⚠️ Falha ao importar cidades do estado {$state->uf}.\n";
            }

            // Pausa pequena para evitar rate-limit
            usleep(300000); // 300ms
        }
    }
}
