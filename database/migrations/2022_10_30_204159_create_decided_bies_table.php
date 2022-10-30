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
        Schema::create('decided_bies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id_number')->constrained('users');
            $table->foreignId('leave_id')->constrained('leaves');
            $table->integer('leaves_available');
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
        Schema::dropIfExists('decided_bies');
    }
};
