<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * Bảng dịch vụ khám
     */
    public function up()
    {
        Schema::create('medical_services', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_services');
    }
}
