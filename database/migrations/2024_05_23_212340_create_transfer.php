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

        Schema::create('sunat_reason', function (Blueprint $table) {
            $table->string('id_reason', 36)->primary();
            $table->string('description_reason', 60);
        });

        Schema::create('sunat_modality', function (Blueprint $table) {
            $table->string('id_modality', 36)->primary();
            $table->string('description_modality', 60);
        });

        Schema::create('sunat_portcode', function (Blueprint $table) {
            $table->string('id_portcode', 36)->primary();
            $table->string('description_portcode', 60);
        });

        Schema::create('sunat_typedocument', function (Blueprint $table) {
            $table->string('id_doc')->primary();
            $table->string('name_doc');
            $table->string('description_doc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sunat_portcode');
        Schema::dropIfExists('sunat_modality');
        Schema::dropIfExists('sunat_reason');
    }
};
