<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pedido;
use App\PedidoProduto;
use App\Produto;

class CozinhaController extends Controller
{
    private $objPedido;
    private $objPedidoProduto;
    public function __construct(){
        $this->objPedido = new Pedido();
        $this->objPedidoProduto = new PedidoProduto();
    }


    public function index(){
        $pedidos = $this->objPedido::whereIn(
            'status', ['PREPARO', 'FEITO']
        )->get();
        return view('cozinha.index', compact('pedidos'));
    }

    public function preparando(){
        $this->middleware('signed');

        $req = Request();
        $idpedido = $req->input('pedido_id');
        $idusuario = Auth::id();

        $check_pedido = Pedido::where([
            'id' => $idpedido,
            'status' => 'FEITO'
        ])->exists();

        if(!$check_pedido){
            $req->session()->flash('mensagem-falha');
            return redirect()->route('cozinha.index');
        }

        PedidoProduto::where([
            'pedido_id' => $idpedido
        ])->update([
            'status' => 'PREPARO'
        ]);

        $req->session()->flash('mensagem-sucesso');

        return redirect()->route('cozinha.index');
    }

    public function compras(){
       $compras = Pedido::where([
        'status' => 'PREPARANDO',
        'users_id' => Auth::id()
       ])->get();

       echo $compras;
    }
}
