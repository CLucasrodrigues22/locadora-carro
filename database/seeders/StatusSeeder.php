<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    public function run()
    {
        DB::table('statusLocacao')->insert(
            [
                [
                    'status' => 'Ativo'
                ],
                [
                    'status' => 'Cancelado'
                ],
                [
                    'status' => 'Finalizado'
                ]
            ]
        );
    }
}
