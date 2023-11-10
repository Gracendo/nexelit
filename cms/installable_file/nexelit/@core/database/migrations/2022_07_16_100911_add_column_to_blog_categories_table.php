<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToBlogCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->string('image')->nullable();
        });
    }

    public function down()
    {
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
