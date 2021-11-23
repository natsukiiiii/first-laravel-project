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
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            // 符号なしBIGINTとは？ものすごい量を格納できるデータ型。$table->foreignId(‘user_id’);も同義

            $table->string('title');
            $table->string('body');
            $table->foreign('user_id')->references('id')->on('users');
            // foreign :foreignメソッドでuser_idを外部キーに設定
            // referencesメソッドで、user_idと紐付いている主テーブルのidを指定する
            // onメソッドで主テーブルusersを指定する。
            //     user_idとpostを紐つけることで、ユーザーが消えると、消えたユーザの投稿も一緒に消すなども可能になる。->onDelete('cascade');とかを追記すれば。
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
