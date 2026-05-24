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
        Schema::create('upload_news', function (Blueprint $table) {
            $table->id();
             $table->string('title');
            $table->string('category');

            $table->text('summary');
            $table->longText('content');

            $table->string('author');
            $table->string('email');

            // image path
            $table->string('image')->nullable();

            // comma separated tags
            $table->string('tags')->nullable();

            // priority
            $table->enum('priority', ['normal', 'high', 'urgent'])->default('normal');

            // draft or published
            $table->boolean('is_draft')->default(false);

            // accepted terms
            $table->boolean('terms_accepted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_news');
    }
};
