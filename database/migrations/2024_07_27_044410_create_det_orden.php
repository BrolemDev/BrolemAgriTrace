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
        Schema::create('det_orden', function (Blueprint $table) {
            $table->id('id_det_orden');
            $table->unsignedBigInteger('id_orden');
            $table->unsignedBigInteger('product_id'); // ID del producto
            $table->string('description'); // Descripción del producto
            $table->integer('quantity'); // Cantidad del producto
            $table->string('unit_of_measure'); // Unidad de medida
            $table->decimal('price', 10, 2); // Precio del producto
            $table->timestamps();

            // Definir claves foráneas
            $table->foreign('id_orden')->references('id_orden')->on('tit_orden')->onDelete('cascade');
            $table->foreign('product_id')->references('id_product')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('det_orden');
    }
};
