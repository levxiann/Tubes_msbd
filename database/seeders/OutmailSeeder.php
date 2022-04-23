<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OutmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $outmails = [];
        $faker = Factory::create();

        for($i = 0 ; $i < 10 ; $i++)
        {
            $outmails[] = [
                'no' => 'OUTMAIL'. ($i+1),
                'mail_type_id' => rand(1, 10),
                'section_id' => rand(1, 10),
                'tanggal_keluar' => $faker->date(),
                'perihal' => $faker->firstName(),
                'pokok_masalah' => $faker->name(),
                'status' => 1,
                'file_surat' => $faker->lastName().'.pdf',
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('outmails')->insert($outmails);
    }
}
