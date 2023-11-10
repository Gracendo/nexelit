<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('slug')->nullable();
            $table->string('lang')->nullable();
            $table->string('regular_price')->nullable();
            $table->string('sale_price')->nullable();
            $table->string('sku')->nullable();
            $table->string('stock_status')->nullable();
            $table->string('category_id')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('attributes_title')->nullable();
            $table->longText('attributes_description')->nullable();
            $table->string('total_sold')->nullable();
            $table->string('badge')->nullable();
            $table->string('image')->nullable();
            $table->string('gallery')->nullable();
            $table->string('status')->nullable();
            $table->string('is_downloadable')->nullable();
            $table->string('downloadable_file')->nullable();
            $table->text('meta_tags')->nullable();
            $table->text('meta_description')->nullable();
            $table->integer('tax_percentage',false,true)->nullable();
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
        Schema::dropIfExists('products');
    }
}
