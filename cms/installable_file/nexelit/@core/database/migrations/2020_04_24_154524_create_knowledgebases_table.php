<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnowledgebasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledgebases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->longText('content')->nullable();
            $table->string('topic_id')->nullable();
            $table->string('status')->nullable();
            $table->string('slug')->nullable();
            $table->string('views')->nullable();
            $table->string('lang')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_tags')->nullable();
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
        Schema::dropIfExists('knowledgebases');
    }
}
