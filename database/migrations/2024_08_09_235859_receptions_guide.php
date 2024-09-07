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

            // Relación con tipo de documento
            $table->string('doc_id');
            $table->foreign('doc_id')->references('id_doc')->on('sunat_typedocument')->onDelete('cascade');

            // Datos de la persona que recibe
            $table->string('document_number'); // Número de documento
            $table->string('first_name'); // Nombres
            $table->string('last_name'); // Apellidos
            $table->string('phone_number')->nullable(); // Número de celular (opcional)

            // Información del envío
            $table->string('condition')->nullable();
            $table->text('observation')->nullable(); // Observaciones

            $table->timestamps();
        });

        Schema::create('reception_images', function (Blueprint $table) {

            $table->id('id'); // Identificador único de la imagen
            $table->unsignedBigInteger('reception_id'); // Relación con la recepción
            $table->foreign('reception_id')->references('id_receptions')->on('receptions')->onDelete('cascade');

            $table->string('image_path'); // Ruta de la imagen
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
        Schema::dropIfExists('reception_images');
        Schema::dropIfExists('receptions');
    }
};
