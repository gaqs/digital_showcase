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
        Schema::create('business', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('score');
            $table->integer('qty_comments');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->string('keywords')->nullable();
            $table->string('email');
            $table->string('email_2')->nullable();
            $table->string('description');
            $table->string('address');
            $table->string('phone');
            $table->string('web')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('mercadolibre')->nullable();
            $table->string('yapo')->nullable();
            $table->string('aliexpress')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('folder')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business');
    }
};
