<?php

use App\Enums\Status;
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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('items')->nullable();
            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique()->index();
            $table->string('status')->default(Status::Draft);
            $table->longText('content')->nullable();
            $table->string('layout')->default('default');
            $table->boolean('front_page')->default(false);
            $table->dateTime('published_at')->nullable();
            $table->string('parent')->nullable();
            $table->softDeletes();

            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique()->index();
            $table->string('status')->default(Status::Draft);
            $table->longText('content')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->foreignId('featured_image_id')->nullable()->references('id')->on('media');
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('menus');
    }
};
