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
        Schema::create('kardex', function (Blueprint $table) {
            $table->id('id_kardex');
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id_branch')->on('branches');
            $table->unsignedBigInteger('personal_id');
            $table->foreign('personal_id')->references('id_personal')->on('personal');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id_product')->on('products');
            $table->string('type_kardex', 40)->nullable()->comment('inventario_inicial, compra, ingreso_transa, salida_transa, venta');
            $table->tinyInteger('status_kardex')->default(1);
            $table->integer('input_quantity')->default(0);
            $table->integer('output_quantity')->default(0);
            $table->integer('stock')->nullable();
            $table->decimal('unit_cost', 10, 2)->default(0.00);
            $table->decimal('total_cost', 10, 2)->default(0.00);
            $table->string('detail_kardex', 240)->nullable();
            $table->string('doctype_kardex', 25)->nullable();
            $table->string('docref_kardex', 25)->nullable();
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

        Schema::dropIfExists('kardex');
    }
};
