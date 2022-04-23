<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [];
        $faker = Factory::create();

        for($i = 0 ; $i < 10 ; $i++)
        {
            $types[] = [
                'nama_jenis_dokumen' => $faker->firstName(),
                'document_group_id' => ($i+1),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('document_types')->insert($types);
    }
}
