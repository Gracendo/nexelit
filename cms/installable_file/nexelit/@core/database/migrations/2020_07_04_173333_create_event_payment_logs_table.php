<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventPaymentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_payment_logs', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('event_name')->nullable();
            $table->string('event_cost')->nullable();
            $table->string('event_gateway')->nullable();
            $table->string('package_gateway')->nullable();
            $table->integer('attendance_id',false,true)->nullable();
            $table->string('status')->nullable();
            $table->longText('transaction_id')->nullable();
            $table->string('track')->nullable();
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
        Schema::dropIfExists('event_payment_logs');
    }
}
