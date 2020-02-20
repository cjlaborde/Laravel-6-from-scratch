<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            # 1) Add string column for the name of the tag
            # 2) Set the name unique to prevent duplicates.
            $table->string('name')->unique();
            $table->timestamps();
        });

        // article_tag convention on how to name it. First singular as the Table you want to create tag for and then tag same as this create_tags_table
        Schema::create('article_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            # 1) connection to article in question
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();
            # 3) Combination of the article_id and tag_id must be unique. That way don't have duplicates
            $table->unique(['article_id', 'tag_id']);
            # 4) Set the foreign key for both.
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
