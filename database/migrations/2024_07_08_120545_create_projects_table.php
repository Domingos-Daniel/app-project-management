<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('supervisor_id')->constrained('users');
            $table->date('end_date');
            $table->date('actual_end_date')->nullable(); // Data real de término
            $table->decimal('budget', 15, 2)->nullable(); // Orçamento
            $table->string('status')->default('em andamento'); // Status do projeto
            $table->string('priority')->default('média'); // Prioridade
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
