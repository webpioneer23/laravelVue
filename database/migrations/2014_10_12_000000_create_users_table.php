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
            $table->string('role');
            $table->string('img')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('country')->nullable();
            $table->integer('payment_status')->nullable();
            $table->string('status')->nullable();
            $table->integer('verified')->nullable();
            $table->string('phone')->nullable();
            $table->integer('hired')->nullable();
            $table->double('salary')->nullable();
            $table->double('hours')->nullable();
            $table->date('end_date')->nullable();
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
