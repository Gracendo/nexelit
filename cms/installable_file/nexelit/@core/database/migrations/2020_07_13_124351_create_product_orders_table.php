<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_track')->nullable();
            $table->string('payment_gateway')->nullable();
            $table->string('user_id')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('coupon_discount')->nullable();
            $table->string('shipping_cost')->nullable();
            $table->string('product_shippings_id')->nullable();
            $table->string('total')->nullable();
            $table->text('billing_name')->nullable();
            $table->text('billing_email')->nullable();
            $table->text('billing_phone')->nullable();
            $table->text('billing_country')->nullable();
            $table->text('billing_street_address')->nullable();
            $table->text('billing_town')->nullable();
            $table->text('billing_district')->nullable();
            $table->text('different_shipping_address')->nullable();
            $table->text('shipping_name')->nullable();
            $table->text('shipping_email')->nullable();
            $table->text('shipping_phone')->nullable();
            $table->text('shipping_country')->nullable();
            $table->text('shipping_street_address')->nullable();
            $table->text('shipping_town')->nullable();
            $table->text('shipping_district')->nullable();
            $table->longText('cart_items')->nullable();
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
        Schema::dropIfExists('product_orders');
    }
}
