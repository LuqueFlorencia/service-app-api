<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('professional_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->time('time');
            $table->text('location')->default('En local');
            $table->string('status')->default('pendiente'); // pending, confirmed, cancelled, etc.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
