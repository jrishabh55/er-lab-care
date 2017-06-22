<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id', false, true);
            $table->float('price');
            $table->float('discount');
            $table->float('paid_amount')->default(0);
            $table->boolean('paid')->default(false);
            $table->string('reference_by')->nullable();
            $table->boolean('printed')->default(false);

            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_reports');
    }
}
