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
            $table->bigIncrements('id');
            $table->boolean('is_deleted')->default(false);
            $table->boolean('rules_accepted')->default(false);
            $table->string('avatar')->default('');
            $table->string('password');
            $table->string('pesel', 11);
            $table->string('name', 100);
            $table->string('specialization', 50);
            $table->string('email', 100);
            $table->string('phone', 50);
            $table->string('address', 100)->default('');
            $table->dateTime('paid_until')->nullable();
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
