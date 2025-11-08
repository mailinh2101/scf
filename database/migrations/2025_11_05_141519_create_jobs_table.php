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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('position');
            $table->longText('description');
            $table->string('location')->nullable();
            $table->string('employment_type')->default('full-time'); // full-time, part-time, contract
            $table->string('salary_range')->nullable();
            $table->longText('requirements')->nullable();
            $table->longText('benefits')->nullable();
            $table->boolean('published')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->string('contact_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
