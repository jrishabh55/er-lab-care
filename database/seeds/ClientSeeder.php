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
            for ($i = 1; $i <= random_int(1, 4); $i++) {
                $lab = $client->labs()->save(factory(App\Lab::class)->make());
                for ($j = 1; $j <= random_int(0, 5); $i++) {
                    $patient = $lab->patients()->save(factory(App\Patient::class)->make());
                    for ($k = 1; $k <= random_int(0, 7); $k++) {
                        $report = $patient->reports()->save(factory(App\PatientReport::class)->make());
                        for ($l = 1; $l <= random_int(3, 10); $l++)
                            $report->tests()->save(factory(App\PatientTest::class)->make());
                    }
                }
            }
        });
    }
}
