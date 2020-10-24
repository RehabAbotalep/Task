<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('address');
            $table->string('dob');
            $table->string('channel_to_promote_in');
            $table->string('website')->nullable();
            $table->bigInteger('governate_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();
            $table->string('email_token')->nullable();
            $table->boolean('email_verified')->default(0);
            $table->string('phone_code')->nullable();
            $table->boolean('phone_verified')->default(0);
            $table->boolean('is_verified')->default(0);
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
