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
        $this->call(SectionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DocumentGroupSeeder::class);
        $this->call(DocumentTypeSeeder::class);
        $this->call(MailTypeSeeder::class);
        $this->call(DocumentSeeder::class);
        $this->call(OutmailSeeder::class);
        $this->call(InmailSeeder::class);
        $this->call(DispositionSeeder::class);
        $this->call(DestinationSeeder::class);
        $this->call(InmailSeeder2::class);
    }
}
