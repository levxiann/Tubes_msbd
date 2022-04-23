<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = [];
        $faker = Factory::create();

        for($i = 0 ; $i < 10 ; $i++)
        {
            $sections[] = [
                'nama_bagian' => $faker->firstName(),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('sections')->insert($sections);
    }
}
