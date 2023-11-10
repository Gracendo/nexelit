<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->string('position');
            $table->string('company_name');
            $table->string('category_id')->nullable();
            $table->string('vacancy')->nullable();
            $table->longText('job_responsibility')->nullable();
            $table->text('employment_status')->nullable();
            $table->longText('education_requirement')->nullable();
            $table->longText('job_context')->nullable();
            $table->longText('experience_requirement')->nullable();
            $table->longText('additional_requirement')->nullable();
            $table->text('job_location')->nullable();
            $table->text('salary')->nullable();
            $table->string('other_benefits')->nullable();
            $table->string('email')->nullable();
            $table->string('status')->nullable();
            $table->string('lang')->nullable();
            $table->string('deadline')->nullable();
            $table->string('application_fee_status')->nullable();
            $table->decimal('application_fee')->nullable();
            $table->text('meta_tags')->nullable();
            $table->text('slug')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
