<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('hospital_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('donor_id')->nullable();
            $table->decimal('donor_long', 11, 8)->nullable();
            $table->decimal('donor_lat', 10, 8)->nullable();
            $table->enum('user_approved', [0, 1])->default(0);
            $table->enum('donor_approved', [0, 1])->default(0);
            $table->enum('status', [0, 1])->default(0);
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
        Schema::dropIfExists('blood_requests');
    }
}
