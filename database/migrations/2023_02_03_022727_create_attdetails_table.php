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
        Schema::create('attdetails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_id')->constrained()->nullOnDelete;
            $table->foreignId('student_id')->constrained('users');
            $table->string('attstatus');
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
        Schema::dropIfExists('attdetails');
    }
};
