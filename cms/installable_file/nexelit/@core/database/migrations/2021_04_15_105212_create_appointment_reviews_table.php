<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('ratings',false,true)->nullable();
            $table->longText('message')->nullable();
            $table->integer('appointment_id',false,true);
            $table->integer('user_id',false,true);
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
        Schema::dropIfExists('appointment_reviews');
    }
}
