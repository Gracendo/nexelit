<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->text('gallery')->nullable();
            $table->text('slug')->nullable();
            $table->string('status')->nullable();
            $table->string('categories_id');
            $table->longText('description');
            $table->text('excerpt')->nullable();
            $table->text('meta_tag')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('duration')->nullable();
            $table->string('clients')->nullable();
            $table->string('budget')->nullable();
            $table->string('image')->nullable();
            $table->string('lang')->nullable();
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
        Schema::dropIfExists('works');
    }
}
