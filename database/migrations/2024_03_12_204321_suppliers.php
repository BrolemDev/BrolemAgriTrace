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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id('id_supplier');
            $table->string('ruc_supplier', 20)->unique();
            $table->string('name_supplier', 100)->unique();
            $table->string('phone_supplier', 20)->nullable();
            $table->string('address_supplier')->nullable();
            $table->string('email_supplier')->nullable();
            $table->string('ubigeo')->nullable();
            $table->boolean('verify_ruc')->default(0);
            $table->string('observation')->nullable();
            $table->string('file_sanitary')->nullable();
            $table->boolean('verify_sanitary')->default(0);
            $table->date('expiry_validate')->nullable();
            $table->date('expiry_sanitary')->nullable();
            $table->boolean('status_supplier')->default(0);
            $table->string('representative');
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
        Schema::dropIfExists('suppliers');
    }
};
