<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->tinyInteger('for_subscriber')->default(1)->comment('0:一般公開、1:有料会員向け');
            $table->string('eye_catch')->default('/img/eyeCatch_default.jpg'); //アイキャッチ画像URL
            $table->string('thumbnail')->default('/img/thumbnail_default.jpg'); //アイキャッチ画像のサムネイルURL
            $table->text('post_title'); //タイトル
            $table->longText('post_content')->nullable(); //本文
            $table->text('post_excerpt')->nullable(); //抜粋
            $table->string('post_status'); //ステータス：「published」「drafted」
            $table->dateTime('post_drafted')->nullable(); //下書き保存日時
            $table->dateTime('post_published')->nullable(); //公開日時
            $table->dateTime('post_modified')->nullable(); //更新日時
            $table->string('post_name')->unique(); //投稿スラッグ(url)
            $table->bigInteger('category_id')->unsigned()->nullable(); //category
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
}
