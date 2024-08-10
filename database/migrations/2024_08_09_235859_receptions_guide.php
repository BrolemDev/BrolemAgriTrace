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
        Schema::create('receptions', function (Blueprint $table) {
            $table->id('id_receptions');
            // Relación con la guía de remisión
            $table->unsignedBigInteger('delivery_guide_id');
            $table->foreign('delivery_guide_id')->references('id')->on('delivery_guides')->onDelete('cascade');

            // Datos de la persona que recibe
            $table->string('document_number'); // Número de documento
            $table->string('first_name'); // Nombres
            $table->string('last_name'); // Apellidos
            $table->string('phone_number')->nullable(); // Número de celular (opcional)

            // Información del envío
            $table->string('status'); // Estado del paquete (por ejemplo: "Entregado", "Pendiente", "Devuelto")
            $table->text('observation')->nullable(); // Observaciones

            // Campos para imágenes
            $table->string('image_path_1')->nullable(); // Ruta de la imagen 1
            $table->string('image_path_2')->nullable(); // Ruta de la imagen 2
            $table->string('image_path_3')->nullable(); // Ruta de la imagen 3

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
        Schema::dropIfExists('receptions');
    }
};
