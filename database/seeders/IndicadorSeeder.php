<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndicadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('indicadores')->insert([
            [
                'nome' => 'Agua',
                'imagem' => 'imagem teste',
                'projeto_id' => 1,
                'fonte_id' => 1,
                'departamento_id' => 1,
                'periodicidade_id' => 1,
                'formula' => 'formula teste',
            ],
            [
                'nome' => 'Ar',
                'imagem' => 'imagem teste',
                'projeto_id' => 1,
                'fonte_id' => 1,
                'departamento_id' => 1,
                'periodicidade_id' => 1,
                'formula' => 'formula teste',
            ],
            [
                'nome' => 'Teste NDTIC',
                'imagem' => 'imagem teste',
                'projeto_id' => 2,
                'fonte_id' => 1,
                'departamento_id' => 1,
                'periodicidade_id' => 1,
                'formula' => 'formula teste',
            ],
        ]);
    }
}
