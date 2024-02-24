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
        Schema::create('roles', function (Blueprint $table) {
            $table->id('id_rol');
            $table->string('name_rol', 80);
            $table->string('descr_rol', 200);
            $table->unsignedBigInteger('office_id');
            $table->foreign('office_id')->references('id_office')->on('offices')->onDelete('cascade');
            $table->text('text_rol', 40)->nullable();
            $table->string('color_rol', 40)->nullable();
            $table->integer('status_rol');
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
        Schema::dropIfExists('roles');
    }
};
