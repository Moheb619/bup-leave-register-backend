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
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->bigInteger('id');
                $table->string('gender');
                $table->string('first_name');
                $table->string('last_name');
                $table->integer('age');
                $table->string('email')->unique();
                $table->string('contact')->unique();
                $table->string('profile');
                $table->foreignId('department_id')->constrained();
                $table->foreignId('designation_id')->constrained();
                $table->string('user_name')->unique();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }
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
