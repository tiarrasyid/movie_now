<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create("id_ID");

        for ($i = 0; $i < 20; $i++) {
            \DB::table('movies')->insert([
                'movie_name' => $faker->sentence(3),
                'movie_rating' => $faker->numberBetween(1, 5),
                'movie_date' => $faker->dateTimeBetween('2024-10-01', '2024-11-01')->format('Y-m-d'),
                'description' => $faker->sentence(3),
            ]);
        }
    }
}
