<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FirstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('networks')->insert([
            'upline_id' => 0
        ]);
    }
}
