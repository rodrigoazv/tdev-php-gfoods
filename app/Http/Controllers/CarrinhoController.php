<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pedido;

class CarrinhoController extends Controller
{
    private $objPedido;
    public function __construct(){
        $this->objPedido = new Pedido();
    }
    public function index(){
        $pedidos = $this->objPedido::where([
            'status' => 'FEITO',
            'users_id' => Auth::id()
        ])->get();

        dd([
            $pedidos,
            $pedidos[0]->pedido_produtos, 
        ]);

        return view('carrinho.index', compact('pedidos'));
    }
}
