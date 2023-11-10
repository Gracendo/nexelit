<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('designation');
            $table->string('lang')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('icon_one')->nullable();
            $table->string('icon_two')->nullable();
            $table->string('icon_three')->nullable();
            $table->string('icon_one_url')->nullable();
            $table->string('icon_two_url')->nullable();
            $table->string('icon_three_url')->nullable();
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
        Schema::dropIfExists('team_members');
    }
}
