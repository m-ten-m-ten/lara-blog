<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->string('image_name')->unique();
            $table->string('image_extension');
            $table->timestamps();
        });

        for ($i = 1; $i < 51; $i++) {
            $image = new App\Image();
            $image->image_name = 'img' . $i;
            $image->image_extension = 'jpg';
            $image->save();
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
}
