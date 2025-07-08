<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cash', function (Blueprint $table) {
    $table->id('CID');
    $table->unsignedInteger('PID'); // 👈 Must match the type of payment.PID
    $table->timestamps();

    $table->foreign('PID')->references('PID')->on('payment')->onDelete('cascade');
});
    }

    public function down(): void {
        Schema::dropIfExists('cash');
    }
};

