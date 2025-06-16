<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->string('province');
            $table->string('department');
            $table->string('address');
            $table->string('avatar')->nullable();
            $table->string('profession')->nullable(); // solo para profesionales
            $table->text('description')->nullable();  // solo para profesionales
            $table->string('availability')->nullable();  // solo para profesionales
            $table->decimal('rating', 3, 2)->nullable();  // solo para profesionales
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
