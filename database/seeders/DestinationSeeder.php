<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $destinations = [];
        $faker = Factory::create();

        for($i = 0 ; $i < 10 ; $i++)
        {
            $destinations[] = [
                'disposition_no' => 'DISPO'.($i + 1),
                'section_id' => rand(1, 10),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('destinations')->insert($destinations);
    }
}
