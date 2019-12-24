<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('post_title'); //タイトル
            $table->longText('post_content')->nullable(); //本文
            $table->text('post_excerpt')->nullable(); //抜粋
            $table->integer('post_thumbnail')->nullable(); //サムネイル画像-Imagesテーブルのid
            $table->string('post_status'); //ステータス：「published」「drafted」
            $table->dateTime('post_drafted')->nullable(); //下書き保存日時
            $table->dateTime('post_published')->nullable(); //公開日時
            $table->dateTime('post_modified')->nullable(); //更新日時
            $table->string('post_name')->nullable(); //投稿スラッグ(url)
            $table->biginteger('category_id')->nullable(); //category
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
