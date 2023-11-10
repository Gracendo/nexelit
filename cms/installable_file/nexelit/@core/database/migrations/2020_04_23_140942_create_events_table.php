<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->longText('content')->nullable();
            $table->string('category_id')->nullable();
            $table->string('status')->nullable();
            $table->string('lang')->nullable();
            $table->string('date');
            $table->string('time');
            $table->string('cost');
            $table->string('available_tickets');
            $table->string('image')->nullable();
            $table->string('organizer')->nullable();
            $table->string('organizer_email')->nullable();
            $table->string('organizer_website')->nullable();
            $table->string('organizer_phone')->nullable();
            $table->text('venue')->nullable();
            $table->text('slug')->nullable();
            $table->text('venue_location')->nullable();
            $table->text('venue_phone')->nullable();
            $table->text('meta_tags')->nullable();
            $table->text('meta_description')->nullable();
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
        Schema::dropIfExists('events');
    }
}
