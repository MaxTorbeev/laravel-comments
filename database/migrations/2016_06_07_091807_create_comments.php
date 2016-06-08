<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->nullable()->default(0)->index();
            $table->integer('post_id');
            $table->integer('parent_id')->nullable()->default(0)->index();
            $table->integer('karma')->nullable()->default(0)->index();
            $table->integer('level')->nullable()->default(0)->index();
            $table->string('user_ip');
            $table->text('content');
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
        Schema::drop('comments');
    }
}
