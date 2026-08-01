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
        // Visitors table - Track unique visitors
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->index();
            $table->text('user_agent')->nullable();
            $table->text('referer')->nullable();
            $table->string('device_type', 20)->nullable(); // desktop, mobile, tablet
            $table->string('browser', 50)->nullable();
            $table->string('os', 50)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->timestamp('first_visit')->useCurrent();
            $table->timestamp('last_visit')->useCurrent();
            $table->integer('visit_count')->default(1);
            $table->timestamps();

            $table->index('last_visit');
        });

        // Page views table - Track page visits
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->string('page_path', 255)->index(); // e.g., /, /about, /services
            $table->string('page_name', 255)->nullable(); // e.g., Home, About, Services
            $table->string('ip_address', 45)->index();
            $table->text('user_agent')->nullable();
            $table->text('referer')->nullable();
            $table->foreignId('visitor_id')->nullable()->constrained('visitors')->onDelete('set null');
            $table->integer('session_duration')->nullable(); // in seconds
            $table->timestamps();

            $table->index('created_at');
            $table->index(['page_path', 'created_at']);
        });

        // Blog views table - Track blog post views
        Schema::create('blog_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained('blogs')->onDelete('cascade');
            $table->string('ip_address', 45)->index();
            $table->text('user_agent')->nullable();
            $table->text('referer')->nullable();
            $table->foreignId('visitor_id')->nullable()->constrained('visitors')->onDelete('set null');
            $table->integer('view_duration')->nullable(); // in seconds
            $table->timestamps();

            $table->index('blog_id');
            $table->index('created_at');
            $table->index(['blog_id', 'created_at']);
        });

        // CTA clicks table - Track CTA button clicks
        Schema::create('cta_clicks', function (Blueprint $table) {
            $table->id();
            $table->string('cta_type', 50)->index(); // whatsapp, email, phone, button, link, etc
            $table->string('cta_label', 255)->nullable(); // Button text or label
            $table->text('cta_url')->nullable(); // Destination URL
            $table->string('page_path', 255)->nullable(); // Where the CTA was clicked
            $table->string('ip_address', 45)->index();
            $table->text('user_agent')->nullable();
            $table->foreignId('visitor_id')->nullable()->constrained('visitors')->onDelete('set null');
            $table->timestamps();

            $table->index('created_at');
            $table->index(['cta_type', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cta_clicks');
        Schema::dropIfExists('blog_views');
        Schema::dropIfExists('page_views');
        Schema::dropIfExists('visitors');
    }
};
