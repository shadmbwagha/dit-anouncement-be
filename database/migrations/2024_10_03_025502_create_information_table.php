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
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            $table->string('title');  // Title of the information
            $table->text('content');  // Information content
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Foreign key referencing categories table
            $table->timestamp('expiration_date')->nullable();  // Optional expiration date
            $table->boolean('is_active')->default(true);  // Flag for active/inactive information
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information');
    }
};
