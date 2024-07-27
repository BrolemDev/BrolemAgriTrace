<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('ruc', 11)->unique();
            $table->string('reason');
            $table->string('ecommerce')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->integer('ubigeo')->nullable(); // Usar 'integer' en lugar de 'int'
            $table->string('urbanization')->nullable();
            $table->string('address')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
