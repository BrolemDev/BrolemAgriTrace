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
        Schema::create('categories', function (Blueprint $table) {
            $table->id('id_category');
            $table->string('code_category', 10)->unique();
            $table->string('name_category', 50)->unique();
            $table->string('sale_category', 20)->nullable();
            $table->string('purchasing_category', 20)->nullable();
            $table->string('img_category', 50)->nullable();
            $table->boolean('status_category')->default(1);
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
        Schema::dropIfExists('categories');
    }
};
