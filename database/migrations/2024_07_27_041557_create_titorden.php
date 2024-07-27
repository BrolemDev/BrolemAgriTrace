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
        // Crear la tabla de tipos de orden
        Schema::create('type_orden', function (Blueprint $table) {
            $table->id('id_typeoc');
            $table->string('description_typeoc');
            $table->timestamps();
        });

        // Crear la tabla de tipos de pago
        Schema::create('type_payment', function (Blueprint $table) {
            $table->id('id_payment');
            $table->string('description_payment');
            $table->timestamps();
        }); 

        // Crear la tabla de órdenes
        Schema::create('tit_orden', function (Blueprint $table) {
            $table->id('id_orden');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('typeoc_id');
            $table->unsignedBigInteger('payment_id');
            $table->string('delivery_time');
            $table->string('observation_delivery');
            $table->string('delivery_place');
            $table->string('raw_material1');
            $table->string('raw_material2');
            $table->string('type_money');
            $table->decimal('total_amount', 10, 2); // Monto total
            $table->decimal('igv_amount', 10, 2); // IGV del monto total
            $table->string('observation_oc');
            $table->timestamps();

            // Definir claves foráneas
            $table->foreign('supplier_id')->references('id_supplier')->on('suppliers')->onDelete('cascade');
            $table->foreign('typeoc_id')->references('id_typeoc')->on('type_orden')->onDelete('cascade');
            $table->foreign('payment_id')->references('id_payment')->on('type_payment')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Eliminar la tabla de órdenes primero
        Schema::dropIfExists('tit_orden');

        // Eliminar las otras tablas
        Schema::dropIfExists('type_payment');
        Schema::dropIfExists('type_orden');
    }
};
