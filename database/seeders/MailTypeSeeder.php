<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MailTypeSeeder extends Seeder
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
                'nama_jenis_surat' => $faker->firstName(),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('mail_types')->insert($types);
    }
}
