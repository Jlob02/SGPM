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
            $table->unsignedBigInteger('familia_id');
            $table->foreign('familia_id')->references('id')->on('familia')->onDelete('cascade');
            $table->unsignedBigInteger('subfamilia_id');
            $table->foreign('subfamilia_id')->references('id')->on('subfamilia')->onDelete('cascade');
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
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
