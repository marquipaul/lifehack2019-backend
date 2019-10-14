<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClearanceDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clearance_descriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('vehicle_id')->nullable();
            $table->integer('processed_by')->nullable();
            $table->string('op_number');
            $table->string('purpose');
            $table->enum('permit_to_assemble', ['false', 'true']);
            $table->enum('record_check', ['false', 'true']);
            $table->string('land_bank_sbr_no')->nullable();
            $table->string('status');
            $table->string('application_status');
            // $table->string('mvcss_action_slip')->nullable();
            // $table->mediumText('mvcss_action_slip_url')->nullable();
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
        Schema::dropIfExists('clearance_descriptions');
    }
}
