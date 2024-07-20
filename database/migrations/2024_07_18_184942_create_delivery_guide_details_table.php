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
        Schema::create('delivery_guides', function (Blueprint $table) {
            $table->id();
            $table->string('reason_id', 36);
            $table->foreign('reason_id')->references('id_reason')->on('sunat_reason');
            $table->string('modality_id', 36);
            $table->foreign('modality_id')->references('id_modality')->on('sunat_modality');
            $table->string('portcode_id', 36)->nullable();
            $table->foreign('portcode_id')->references('id_portcode')->on('sunat_portcode');
            $table->string('ruc_destiny');
            $table->string('reason_destiny');
            $table->string('email_destiny')->nullable();
            $table->date('init_transfer');
            $table->decimal('weight_transfer', 8, 2);
            $table->integer('package_transfer');
            $table->string('container_transfer')->nullable();
            $table->string('doc_transport');
            $table->string('number_transport');
            $table->string('names_transport');
            $table->string('plate_transport');
            $table->string('address_point');
            $table->string('address_destiny');
            $table->string('ubigeo_origin');
            $table->string('ubigeo_destiny');
            $table->timestamps();
        });

        Schema::create('delivery_guide_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('delivery_guide_id');
            $table->foreign('delivery_guide_id')->references('id')->on('delivery_guides')->onDelete('cascade');
            $table->integer('product_id');
            $table->string('code');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('unit');
            $table->decimal('weight', 8, 2);
            $table->integer('quantity');
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
        Schema::dropIfExists('delivery_guide_details');
        Schema::dropIfExists('delivery_guides');
    }
};
