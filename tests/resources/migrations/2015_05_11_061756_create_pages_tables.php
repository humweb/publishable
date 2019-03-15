<?php

use Illuminate\Database\Migrations\Migration;

class CreatePagesTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function ($table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('posts', function ($table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->timestamp('published_on')->nullable();
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
        Schema::drop('pages');
    }

}
