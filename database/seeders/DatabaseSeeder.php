<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        for ($i = 0; $i < 5; $i++) {
            $grupo = \App\Models\Grupo::factory()->create();
            // $c->settings()->set('estado', 'producao');
            $numsistemas = mt_rand(1, 5);
            for ($j = 1; $j <= $numsistemas; $j++) {
                $sistema = \App\Models\Sistema::factory()->create();
            }
        }
    }
}
