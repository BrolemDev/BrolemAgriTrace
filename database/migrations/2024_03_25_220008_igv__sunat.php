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
        Schema::create('sunat_igv', function (Blueprint $table) {
            $table->id('id_igv');
            $table->string('description_igv');
            $table->timestamps();
        });

        Schema::create('sunat_extent', function (Blueprint $table) {
            $table->id('id_extent');
            $table->string('code_extent');
            $table->string('name_extent');
            $table->string('symbol_extent');
            $table->timestamps();
        });
        Schema::create('sunat_detraction', function (Blueprint $table) {
            $table->id('id_detraction');
            $table->string('decription_detraction');
            $table->string('percentage_detraction');
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
        Schema::dropIfExists('sunat_detraction');
        Schema::dropIfExists('sunat_extent');
        Schema::dropIfExists('sunat_igv');
    }
};
