<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_product');
            $table->string('code_product', 7)->unique();
            $table->string('name_product', 200);+
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id_category')->on('categories');
            $table->unsignedBigInteger('extent_id');
            $table->foreign('extent_id')->references('id_extent')->on('sunat_extent');
            $table->int('igv_id', 20)->nullable();
            $table->decimal('price_pen', 10, 2)->nullable();
            $table->decimal('price_usd', 10, 2)->nullable();

            $table->int('stock');
            $table->int('stock_min')->default(1);
            $table->int('detraction')->nullable();
            $table->string('detail_product', 200);
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
};
