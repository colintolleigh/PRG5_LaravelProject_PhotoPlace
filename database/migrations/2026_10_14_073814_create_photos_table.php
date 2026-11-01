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
        Schema::create('photos', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('title', 255);
            $table->string('description', 255)->nullable();
            $table->string('image_path', 255);

            $table->string('location', 255)->nullable();
            $table->string('camera', 255)->nullable();
            $table->string('lens', 255)->nullable();
            $table->string('focal_length', 50)->nullable();
            $table->string('aperture', 50)->nullable();
            $table->string('shutter_speed', 50)->nullable();
            $table->integer('iso')->nullable();
            $table->date('taken_at')->nullable();

            $table->boolean('is_visible')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
