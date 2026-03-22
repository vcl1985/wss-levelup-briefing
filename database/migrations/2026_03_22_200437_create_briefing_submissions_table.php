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
        Schema::create('briefing_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('briefing_type_id')->constrained()->cascadeOnDelete();
            $table->string('empresa');
            $table->string('responsavel_nome')->nullable();
            $table->string('responsavel_email')->nullable();
            $table->string('responsavel_contato')->nullable();
            $table->json('data');
            $table->enum('status', ['novo', 'em_analise', 'concluido'])->default('novo');
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('briefing_submissions');
    }
};
