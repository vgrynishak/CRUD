<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'user'=>'Volodya',
                'password'=>hash('whirlpool',111111)
            ],
            [
                'user'=>'admin',
                'password'=>hash('whirlpool','admin')
            ]
        ]);
    }
}
