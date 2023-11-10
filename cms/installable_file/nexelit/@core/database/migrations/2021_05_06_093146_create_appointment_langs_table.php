<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( Schema::hasTable('appointment_langs')){
            return;
        }
        Schema::create('appointment_langs', function (Blueprint $table) {
            $table->id();
            $table->longText('description')->nullable();
            $table->longText('additional_info')->nullable();
            $table->longText('experience_info')->nullable();
            $table->longText('specialized_info')->nullable();
            $table->text('location')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_tags')->nullable();
            $table->text('slug')->nullable();
            $table->text('short_description')->nullable();
            $table->string('lang')->nullable();
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->text('title')->nullable();
            $table->string('designation')->nullable();
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
        Schema::dropIfExists('appointment_langs');
    }
}
