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

            $table->string('title', 255);
            $table->string('description', 255);
            $table->string('own_image_path', 255);
            $table->string('location', 255);
            $table->string('camera', 255);
            $table->string('lens', 255);
            $table->string('focal_length', 50);
            $table->string('aperture', 50);
            $table->string('shutter_speed', 50);
            $table->integer('iso');
            $table->date('taken_at');


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
