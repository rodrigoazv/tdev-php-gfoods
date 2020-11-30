<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pedido;
use App\PedidoProduto;

class CarrinhoController extends Controller
{
    private $objPedido;
    private $objPedidoProduto;
    public function __construct(){
        $this->objPedido = new Pedido();
        $this->objPedidoProduto = new PedidoProduto();
    }
    public function index(){
        $pedidos = $this->objPedido::where([
            'status' => 'FEITO',
            'users_id' => Auth::id()
        ])->get();
        $pedidos_p = $this->objPedidoProduto::where([
            'pedido_id' => $pedidos[0]->id,
        ])->get();

        return view('carrinho.index', compact('pedidos'));
    }
}
