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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id');
            $table->integer('user_id');
            $table->integer('categories_id');
            $table->string('name');
            $table->string('description');
            $table->string('price')->nullable();
            $table->decimal('score',2,1)->default(5.0);
            $table->integer('qty_comments');
            $table->string('mercadolibre')->nullable();
            $table->string('facebook')->nullable();
            $table->string('yapo')->nullable();
            $table->string('aliexpress')->nullable();
            $table->json('others')->nullable();
            $table->integer('stock')->nullable(); //?
            $table->string('folder');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
