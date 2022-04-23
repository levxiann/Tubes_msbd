<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [];
        $faker = Factory::create();

        for($i = 0 ; $i < 10 ; $i++)
        {
            $groups[] = [
                'nama_kelompok_dokumen' => $faker->firstName(),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('document_groups')->insert($groups);
    }
}
