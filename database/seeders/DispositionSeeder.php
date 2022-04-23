<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DispositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dispositions = [];
        $faker = Factory::create();

        for($i = 0 ; $i < 10 ; $i++)
        {
            $dispositions[] = [
                'no' => 'DISPO'. ($i+1),
                'inmail_no' => 'INMAIL'. ($i+1),
                'tanggal_disposisi' => $faker->date(),
                'isi_disposisi' => $faker->text(rand(20, 50)),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('dispositions')->insert($dispositions);
    }
}
