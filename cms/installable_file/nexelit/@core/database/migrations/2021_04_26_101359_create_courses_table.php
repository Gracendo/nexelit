<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('status')->nullable();
            $table->string('duration')->nullable();
            $table->string('duration_type')->nullable();
            $table->unsignedBigInteger('max_student')->nullable();
            $table->string('enrolled_student')->nullable();
            $table->string('featured')->nullable();
            $table->text('external_url')->nullable();
            $table->float('price')->nullable();
            $table->float('sale_price')->nullable();
            $table->string('enroll_required')->nullable();
            $table->unsignedBigInteger('og_meta_image')->nullable();
            $table->unsignedBigInteger('instructor_id')->nullable();
            $table->text('curriculum_id')->nullable();
            $table->unsignedBigInteger('categories_id')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
