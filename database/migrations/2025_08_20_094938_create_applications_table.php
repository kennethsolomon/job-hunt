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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('company_id')->nullable()->constrained()->nullOnDelete();
            $table->string('role');
            $table->string('source_url')->nullable();
            $table->text('job_description')->nullable();
            $table->enum('status', ['prospect','applied','replied','interview','offer','accepted','rejected','archived'])->index();
            $table->integer('salary_ask')->nullable();
            $table->integer('salary_offer')->nullable();
            $table->date('applied_on')->nullable();
            $table->dateTimeTz('next_follow_up_at')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
