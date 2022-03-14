<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleAndPermissionSeeder::class);
        $this->call(StaticOptionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RenewPassportSeeder::class);
        $this->call(ManualPassportSeeder::class);
        $this->call(LostPassportSeeder::class);
        $this->call(NewBornBabyPassportSeeder::class);
        $this->call(OtherServiceSeeder::class);
        $this->call(ProfessionSeeder::class);
        $this->call(PassportFeeSeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(SalareySeeder::class);
        $this->call(OtherServiceFeeSeeder::class);
        $this->call(DeliverySeeder::class);
    }
}
