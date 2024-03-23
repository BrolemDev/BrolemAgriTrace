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
        Schema::create('branches', function (Blueprint $table) {
            $table->id('id_branch');
            $table->string('anexo_branch')->nullable();
            $table->string('name_branch');
            $table->string('address_branch')->nullable();
            $table->string('urbanzation_branch')->nullable();
            $table->string('ubigeo_branch')->nullable();
            $table->string('phone_branch')->nullable();
            $table->string('email_branch')->nullable();
            $table->integer('status_branch')->default(1);
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
        Schema::dropIfExists('branches');
    }
};
