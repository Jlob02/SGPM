<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materiasprimas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('designacao');
            $table->string('codigo', 20);
            $table->float('concentracao');
            $table->integer('familia_id');
            $table->integer('subfamilia_id');
            $table->integer('empresa_id');
            $table->string('principio_activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiasprimas');
    }
};
