<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('status');
            $table->string('application_status');
            $table->enum('crime_lab_inspection', ['pending', 'done']);
            $table->enum('hpg_inspection', ['pending', 'done']);
            $table->mediumText('findings')->nullable();
            $table->string('qr_code');
            $table->string('body_type');
            $table->string('make');
            $table->string('series');
            $table->string('year_model');
            $table->string('color');
            $table->string('engine_number');
            $table->string('chassis_number');
            $table->string('me_control_number');
            $table->string('lto_cc_number');
            $table->enum('classification', ['private', 'government', 'fo-hire', 'diplomat']);
            $table->string('plate_number')->nullable();
            $table->string('mv_file_number')->nullable();
            $table->string('mvrr_number')->nullable();
            $table->string('cr_number')->nullable();
            $table->string('scanned_stencil_chassis')->nullable();
            $table->string('scanned_stencil_motor')->nullable();
            $table->mediumText('scanned_stencil_chassis_url')->nullable();
            $table->mediumText('scanned_stencil_motor_url')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
}
