<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        //deleting tables/*
        DB::table('users')->delete();
        DB::table('calendars')->delete();
        DB::table('events')->delete();
                
        $this->call('UserTableSeeder');
        $this->call('ApiSeeder');
        $this->command->info('Seeding finished.'); // show information in the command line after everything is run
        Model::reguard();
    }
}
