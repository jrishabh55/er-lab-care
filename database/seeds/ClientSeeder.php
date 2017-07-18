<?php

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Client::class, 20)->create()->each(function ($client) {
//            $order = $client->orders()->save(factory(App\Order::class)->make());
//            $this->command->info('Order seeded');
//            $client->licences()->saveMany(factory(App\Licence::class, 3)->make(['order_id' => $order->id]));
//            $this->command->info('Licence Seeded');
//            for ($i = 1; $i <= random_int(1, 3); $i++) {
//                $this->command->info('Lab: ' . $i . ' Seeding');
//                $lab = $client->labs()->save(factory(App\Lab::class)->make());
//                $this->command->info('Lab: ' . $i . ' Seeded');
//                for ($j = 1; $j <= random_int(1, 3); $j++) {
//                    $this->command->info('Patient: ' . $j . ' Seeding');
//                    $patient = $lab->patients()->save(factory(App\Patient::class)->make());
//                    $this->command->info('Patient: ' . $j . ' Seeded');
//                    for ($k = 1; $k <= random_int(1, 4); $k++) {
//                        $this->command->info('Reports: ' . $k . ' Seeded');
//                        $report = $patient->reports()->save(factory(App\PatientReport::class)->make());
//                        $this->command->info('Reports: ' . $k . ' Seeded');
//                        for ($l = 1; $l <= random_int(2, 6); $l++) {
//                            $this->command->info('Tests: ' . $l . ' Seeding');
//                            $report->tests()->save(factory(App\PatientTest::class)->make());
//                            $this->command->info('Tests: ' . $l . ' Seeded');
//                        }
//                    }
//                }
//            }
        });
    }
}
