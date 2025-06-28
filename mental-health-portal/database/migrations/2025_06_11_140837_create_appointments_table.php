<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('appointments', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('doctor_id');
        $table->unsignedBigInteger('user_id'); // add user_id if your team makes user system
        $table->date('appointment_date');
        $table->time('appointment_time');
        $table->timestamps();

        $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        // You can add user_id foreign key too later
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
