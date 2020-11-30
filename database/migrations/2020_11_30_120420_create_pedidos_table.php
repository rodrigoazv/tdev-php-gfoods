<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->unsigned();
            $table->integer('cupom_id')->nullable()->unsigned();
            $table->enum('status', ['FEITO', 'PREPARO', 'CANCELADO', 'FINALIZADO']);
            $table->decimal('desconto', 6,2)->default(0);
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('cupom_id')->references('id')->on('cupoms');
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
        Schema::dropIfExists('pedidos');
    }
}
