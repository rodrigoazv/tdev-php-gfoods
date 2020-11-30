<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function index(){
        $pedidos = App\Pedido::where([
            'status' => 'FEITO',
            'users_id' => Auth::id()
        ])->get();

        return view('carrinho.index', compact('pedidos'));
    }
}
