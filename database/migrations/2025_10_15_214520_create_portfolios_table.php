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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('client_name')->nullable();
            $table->foreignId('service_id')->nullable()->constrained()->nullOnDelete();
            $table->text('description');
            $table->text('challenge')->nullable();
            $table->text('solution')->nullable();
            $table->text('result')->nullable();
            $table->string('project_url')->nullable();
            $table->string('thumbnail');
            $table->date('completed_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->index('slug');
            $table->index('service_id');
            $table->index('is_featured');
            $table->index('is_published');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
