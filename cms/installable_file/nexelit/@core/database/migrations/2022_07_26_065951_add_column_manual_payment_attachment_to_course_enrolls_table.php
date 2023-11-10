<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnManualPaymentAttachmentToCourseEnrollsTable extends Migration
{

    public function up()
    {
        Schema::table('course_enrolls', function (Blueprint $table) {
            $table->string('manual_payment_attachment')->nullable();
        });
    }

    public function down()
    {
        Schema::table('course_enrolls', function (Blueprint $table) {
            $table->dropColumn('manual_payment_attachment');
        });
    }
}
