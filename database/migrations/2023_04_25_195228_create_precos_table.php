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
        Schema::create('precos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('preco',5,4);
            $table->integer('unidade');
            $table->integer('materiaprima_id');
            $table->integer('fornecedor_id');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->integer('empresa_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('precos');
    }
};
