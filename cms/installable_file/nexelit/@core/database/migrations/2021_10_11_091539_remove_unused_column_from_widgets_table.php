<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUnusedColumnFromWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('widgets', function (Blueprint $table) {
            if (Schema::hasColumn('widgets', 'frontend_render_function')) {
                $table->dropColumn('frontend_render_function');
            }
            if (Schema::hasColumn('widgets', 'admin_render_function')) {
                $table->dropColumn('admin_render_function');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('widgets', function (Blueprint $table) {
            if (!Schema::hasColumn('widgets', 'frontend_render_function')) {
                $table->string('frontend_render_function');
            }
            if (!Schema::hasColumn('widgets', 'admin_render_function')) {
                $table->string('admin_render_function');
            }
        });
    }
}
