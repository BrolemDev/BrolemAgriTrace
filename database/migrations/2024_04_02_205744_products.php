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
            $table->string('name_product', 200);
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id_branch')->on('branches');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id_category')->on('categories');
            $table->unsignedBigInteger('extent_id');
            $table->foreign('extent_id')->references('id_extent')->on('sunat_extent');
            $table->unsignedBigInteger('igv_id');
            $table->foreign('igv_id')->references('id_igv')->on('sunat_igv');
            $table->decimal('price_pen', 10, 2)->nullable();
            $table->decimal('price_pen_igv', 10, 2)->nullable();
            $table->decimal('price_usd', 10, 2)->nullable();
            $table->decimal('price_usd_igv', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->integer('stock_min')->default(0);
            $table->unsignedBigInteger('detraction_id')->nullable();
            $table->foreign('detraction_id')->references('id_detraction')->on('sunat_detraction');
            $table->string('detail_product', 200)->nullable();
            $table->boolean('status_product')->default(1);
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
