<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('widgets')) {
            Schema::table('widgets', function (Blueprint $table) {
                $table->string('widget_location')->nullable();
                $table->string('widget_area')->nullable();
                if (Schema::hasColumn('widgets', 'admin_render_function')) {
                    $table->dropColumn('admin_render_function');
                }
                if (Schema::hasColumn('widgets', 'frontend_render_function')) {
                    $table->dropColumn('frontend_render_function');
                }

            });

        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('widgets', function (Blueprint $table) {
            $table->dropColumn('widget_location');
            $table->dropColumn('widget_area');
            $table->string('admin_render_function');
            $table->string('frontend_render_function');
        });
    }
}
