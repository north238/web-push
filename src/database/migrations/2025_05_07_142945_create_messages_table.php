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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('text')->nullable()->comment('テキスト');
            $table->string('file_path')->nullable()->comment('画像ファイルのパス');
            $table->unsignedBigInteger('post_user_id')->comment('送信者のID'); // usersテーブルからリレーション
            $table->unsignedBigInteger('receive_user_id')->nullable()->comment('受信者のID'); // usersテーブルからリレーション
            $table->timestamps();

            $table->foreign('post_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receive_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
