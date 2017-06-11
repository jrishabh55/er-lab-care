<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_report_id', false, true);
            $table->integer('test_id', false, true);
            $table->float('value');
            $table->float('price');

            $table->timestamps();

            $table->foreign('patient_report_id')->refereces('id')->on('patient_reports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_tests');
    }
}
