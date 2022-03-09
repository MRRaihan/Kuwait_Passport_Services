<?php

namespace Database\Seeders;

use App\Models\Salary;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class SalareySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 4; $i++) {
            $salary = new Salary();
            $salary->title = $faker->name;
            $salary->status = 1;
            $salary->amount = $faker->numberBetween(500, 600);
            $salary->save();
        }
    }
}
