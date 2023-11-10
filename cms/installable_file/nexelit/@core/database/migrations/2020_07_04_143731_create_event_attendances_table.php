<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_attendances', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('pending');
            $table->string('payment_status')->default('pending');
            $table->string('event_name')->nullable();
            $table->string('checkout_type')->nullable();
            $table->integer('user_id',false,true)->nullable();
            $table->string('event_cost')->nullable();
            $table->string('event_id')->nullable();
            $table->string('quantity')->nullable();
            $table->longText('custom_fields')->nullable();
            $table->longText('attachment')->nullable();
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
        Schema::dropIfExists('event_attendances');
    }
}
