<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['id' => 12,  'name' => 'Acre', 'uf' => 'AC'],
            ['id' => 27,  'name' => 'Alagoas', 'uf' => 'AL'],
            ['id' => 16,  'name' => 'Amapá', 'uf' => 'AP'],
            ['id' => 13,  'name' => 'Amazonas', 'uf' => 'AM'],
            ['id' => 29,  'name' => 'Bahia', 'uf' => 'BA'],
            ['id' => 23,  'name' => 'Ceará', 'uf' => 'CE'],
            ['id' => 53,  'name' => 'Distrito Federal', 'uf' => 'DF'],
            ['id' => 32,  'name' => 'Espírito Santo', 'uf' => 'ES'],
            ['id' => 52,  'name' => 'Goiás', 'uf' => 'GO'],
            ['id' => 21,  'name' => 'Maranhão', 'uf' => 'MA'],
            ['id' => 51,  'name' => 'Mato Grosso', 'uf' => 'MT'],
            ['id' => 50,  'name' => 'Mato Grosso do Sul', 'uf' => 'MS'],
            ['id' => 31,  'name' => 'Minas Gerais', 'uf' => 'MG'],
            ['id' => 15,  'name' => 'Pará', 'uf' => 'PA'],
            ['id' => 25,  'name' => 'Paraíba', 'uf' => 'PB'],
            ['id' => 41,  'name' => 'Paraná', 'uf' => 'PR'],
            ['id' => 26,  'name' => 'Pernambuco', 'uf' => 'PE'],
            ['id' => 22,  'name' => 'Piauí', 'uf' => 'PI'],
            ['id' => 33,  'name' => 'Rio de Janeiro', 'uf' => 'RJ'],
            ['id' => 24,  'name' => 'Rio Grande do Norte', 'uf' => 'RN'],
            ['id' => 43,  'name' => 'Rio Grande do Sul', 'uf' => 'RS'],
            ['id' => 11,  'name' => 'Rondônia', 'uf' => 'RO'],
            ['id' => 14,  'name' => 'Roraima', 'uf' => 'RR'],
            ['id' => 42,  'name' => 'Santa Catarina', 'uf' => 'SC'],
            ['id' => 35,  'name' => 'São Paulo', 'uf' => 'SP'],
            ['id' => 28,  'name' => 'Sergipe', 'uf' => 'SE'],
            ['id' => 17,  'name' => 'Tocantins', 'uf' => 'TO'],
        ];

        foreach ($states as $state) {
            State::updateOrCreate(
                ['id' => $state['id']],
                [
                    'name' => $state['name'],
                    'uf' => $state['uf'],
                    'country_id' => 55
                ]
            );
        }
    }
}
