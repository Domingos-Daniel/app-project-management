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
        Schema::create('changes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained();
            $table->foreignId('user_id')->constrained('users');
            $table->string('title'); // Título da alteração
            $table->text('description');
            $table->boolean('approved')->default(false);
            $table->timestamp('timestamp')->useCurrent(); // Timestamp da alteração
            $table->string('attachment')->nullable(); // Anexo
            $table->text('reason')->nullable(); // Razão para a alteração
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('changes');
    }
};
