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
        Schema::create('home_sections', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // why_choose_us, how_it_works, case_studies, intro_video, features, faqs, testimonials
            $table->string('title')->nullable(); // Section title (h3)
            $table->text('heading')->nullable(); // Main heading (h2)
            $table->text('subtitle')->nullable(); // Subtitle/description (p)
            $table->text('content')->nullable(); // Additional content
            $table->string('image')->nullable(); // Main image for section
            $table->string('image_2')->nullable(); // Additional image
            $table->string('image_3')->nullable(); // Additional image
            $table->string('video_url')->nullable(); // For intro video section
            $table->json('extra_data')->nullable(); // For flexible data storage
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_sections');
    }
};
