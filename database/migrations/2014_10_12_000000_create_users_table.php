<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id_number')->primary();
            $table->string('gender');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('age');
            $table->string('email')->unique();
            $table->string('contact')->unique();
            $table->string('profile');
            $table->string('department');
            $table->string('designation');
            $table->string('user_name')->unique();
            $table->string('password');
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
};
