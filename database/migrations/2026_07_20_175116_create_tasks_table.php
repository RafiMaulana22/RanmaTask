<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            // User yang memiliki task
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Judul task
            $table->string('title');

            // Deskripsi (boleh kosong)
            $table->text('description')->nullable();

            // Prioritas
            $table->enum('priority', ['Low', 'Medium', 'High'])->default('Medium');

            // Status
            $table->enum('status', ['Pending', 'Completed'])->default('Pending');

            // Deadline
            $table->date('deadline')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
