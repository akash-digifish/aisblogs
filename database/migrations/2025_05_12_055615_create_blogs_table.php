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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('blog_name');
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description');
            $table->string('author');
            $table->date('create_date');
            $table->timestamp('published_at')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->string('featured_image')->nullable();
          
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->json('tags')->nullable();
            $table->integer('view_count')->default(0);
            $table->integer('read_time')->nullable(); // calculate from word count
            $table->string('language')->default('en');
            $table->enum('visibility', ['public', 'private', 'unlisted'])->default('public');
            $table->timestamps();
            $table->softDeletes(); // optional
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
