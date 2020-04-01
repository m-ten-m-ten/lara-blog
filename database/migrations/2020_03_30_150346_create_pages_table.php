<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->text('page_title'); //タイトル
            $table->longText('page_content')->nullable(); //本文
            $table->string('page_status'); //ステータス：「published」「drafted」
            $table->string('page_name')->unique(); //投稿スラッグ(url)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
}
