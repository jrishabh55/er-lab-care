<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Rishabh Jain',
            'email' => 'jrishabh55@gmail.com',
            'username' => 'admin',
            'password' => bcrypt("password"),
        ]);

        $this->call(ProductSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(PromotionSeeder::class);
//        $this->call(LicenceSeeder::class);
    }
}
