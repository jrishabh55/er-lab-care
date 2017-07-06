<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id', false, true);
            $table->integer('product_id', false, true);
            $table->integer('order_id', false, true);
            $table->boolean('active')->default(false);
            $table->string('mac_address', 20)->default('00:00:00:00:00:00');
            $table->text('hdd_id')->nullable();
            $table->string('longitude')->default('0000');
            $table->string('latitude')->default('0000');
            $table->string('key', 30);
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licences');
    }
}
