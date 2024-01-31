<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VendaProduto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venda_produto', function (Blueprint $table) {
            $table->unsignedBigInteger('venda_id');
            $table->unsignedBigInteger('produto_id');

            $table->foreign('venda_id','Venda_Produto_FKIndex1')->references('id')->on('vendas');
            $table->foreign('produto_id','Venda_Produto_FKIndex2')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venda_produto');
    }
}
