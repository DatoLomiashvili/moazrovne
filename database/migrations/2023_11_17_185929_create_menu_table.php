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
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('redirect')->nullable();
            $table->string('target')->nullable()->default('_self');
            $table->boolean('visible')->default(true);
            $table->foreignId("image_id")->nullable()->constrained('media')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId("page_id")->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('parent_id')->default(-1);
            $table->integer('order')->default(0)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
