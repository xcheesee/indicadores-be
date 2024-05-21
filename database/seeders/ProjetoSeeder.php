<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjetoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projetos')->insert([
            [
                'nome' => 'Padrao',
                'departamento_id' => 1,
            ],
            [
                'nome' => 'NDTIC',
                'departamento_id' => 1,
            ],
        ]);
    }
}
