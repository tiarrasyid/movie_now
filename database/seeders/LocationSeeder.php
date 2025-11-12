<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create("id_ID");

        $locations = ['Jakarta', 'Alam Sutera', 'Bekasi'];
        $movies = \DB::table('movies')->pluck('movie_id')->toArray();

        for ($i = 0; $i < count($locations); $i++) {
            \DB::table('locations')->insert([
                'location_name' => $locations[$i],
                'movie_id' => $faker->randomElement($movies),
                'location_details' => $faker->sentence(2),
                'created_at' => now(),
            ]);
        }
    }
}
