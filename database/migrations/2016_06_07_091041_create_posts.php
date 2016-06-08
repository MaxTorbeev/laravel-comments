<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('alias');
            $table->string('title');
            $table->text('intro_text')->nullable();
            $table->text('body');
            $table->text('image')->nullable();
            $table->text('metakey')->nullable();
            $table->text('metadesc')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            // Если пользователь удаляет аккаунт
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
