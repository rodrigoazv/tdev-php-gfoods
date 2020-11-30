<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pedido;
use App\PedidoProduto;
use App\Produto;

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

        return view('carrinho.index', compact('pedidos'));
    }


    public function adicionar(){
        $this->middleware('signed');

        $req = Request();
        $idproduto = $req->input('id');

        $produto = Produto::find($idproduto);
        if(empty($produto->id)){
            $req->session()->flash('Mensagem-falha', 'Não tem esse');
            return redirect()->route('carrinho.index');
        }

        $idusuario = Auth::id();

        $idpedido = Pedido::consultaId([
            'users_id' => $idusuario,
            'status' => 'FEITO'
        ]);
        echo $idpedido;
        if(empty($idpedido)){
            $pedido_novo = Pedido::create([
                'users_id' => $idusuario,
                'status' => 'FEITO'
            ]);

            $idpedido = $pedido_novo->id;
        }
        PedidoProduto::create([
            'pedido_id' => $idpedido,
            'produto_id' => $idproduto,
            'status' => 'FEITO'
        ]);

        $req->session()->flash('mensagem-sucesso', "Adding");
        return redirect()->route('carrinho.index');

    }
}
