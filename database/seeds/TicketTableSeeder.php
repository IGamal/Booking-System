<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //insert tickets available number in database
        DB::table('tickets')->insert
        ([
            'student' => 200,
            'normal' => 200
        ]);
    }
}
