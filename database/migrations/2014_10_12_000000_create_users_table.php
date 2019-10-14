<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('qr_code');//dfd
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name');
            $table->date('birthday');
            $table->string('tin_number')->nullable();
            $table->mediumText('address');
            $table->enum('gender', ['male', 'female']);
            $table->enum('user_type', ['applicant', 'police', 'staff1', 'staff2', 'admin']);//dffd
            $table->string('email')->unique();
            $table->string('mobile_number')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->mediumText('avatar_url')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
