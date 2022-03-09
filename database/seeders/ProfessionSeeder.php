<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 5; $i++) {
            $profession = new Profession();
            $profession->name = $faker->name;
            $profession->status = 1;
            $profession->save();
        }
    }
}
