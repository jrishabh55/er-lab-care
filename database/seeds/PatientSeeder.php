<?php

use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Patient::class, 50)->create()->each(function ($patient) {
            for ($i = 1; $i <= 10; $i++) {
                $p = $patient->reports()->save(factory(App\PatientReport::class)->make());
                for ($j = 1; $j <= 10; $j++)
                    $p->tests()->save(factory(App\PatientTest::class)->make());
            }
        });
    }
}
