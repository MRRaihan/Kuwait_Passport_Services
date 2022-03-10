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
        Profession::create([
            'name' => 'Plumber',
            'status' => 1
        ]);

        Profession::create([
            'name' => 'Painter',
            'status' => 1
        ]);

        Profession::create([
            'name' => 'Factory Worker',
            'status' => 1
        ]);

        Profession::create([
            'name' => 'Labour',
            'status' => 1
        ]);

        Profession::create([
            'name' => 'Car Cleaner',
            'status' => 1
        ]);

        Profession::create([
            'name' => 'Welder',
            'status' => 1
        ]);

        Profession::create([
            'name' => 'Shafe',
            'status' => 1
        ]);

        Profession::create([
            'name' => 'Driver',
            'status' => 1
        ]);

        Profession::create([
            'name' => 'Office Assistant',
            'status' => 1
        ]);

        Profession::create([
            'name' => 'Computer Operator',
            'status' => 1
        ]);

        Profession::create([
            'name' => 'Cleaner',
            'status' => 1
        ]);

        Profession::create([
            'name' => 'Data Enterer',
            'status' => 1
        ]);
    }
}
