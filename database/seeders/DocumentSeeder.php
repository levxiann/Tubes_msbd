<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $docs = [];
        $faker = Factory::create();

        for($i = 0 ; $i < 10 ; $i++)
        {
            $docs[] = [
                'no' => 'DOC'. ($i+1),
                'nama_dokumen' => $faker->name(),
                'document_type_id' => rand(1, 10),
                'section_id' => ($i+1),
                'sifat_dokumen' => rand(0, 1)? 1 : 2,
                'tanggal_terbit' => $faker->date(),
                'perihal' => $faker->firstName(),
                'file_dokumen' => $faker->lastName().'.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('documents')->insert($docs);
    }
}
