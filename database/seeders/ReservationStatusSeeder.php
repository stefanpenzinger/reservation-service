<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReservationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reservation_status')->insert([
            'status' => "CANC_AD",
            'description' => "Cancelled by admin."
        ]);
        DB::table('reservation_status')->insert([
            'status' => "CANC_CO",
            'description' => "Cancelled by customer."
        ]);
        DB::table('reservation_status')->insert([
            'status' => "CHECKIN",
            'description' => "Customer checked in."
        ]);
        DB::table('reservation_status')->insert([
            'status' => "CHECKOUT",
            'description' => "Customer checked out."
        ]);
        DB::table('reservation_status')->insert([
            'status' => "CANC_TI",
            'description' => "Cancelled because customer was over the reservation time before checkin."
        ]);
    }
}
