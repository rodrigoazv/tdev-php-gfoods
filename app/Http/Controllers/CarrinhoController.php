<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pedido;
use App\PedidoProduto;
use App\Cupom;
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
            'users_id' => Auth::id()
        ])->whereIn(
            'status', ['PREPARO', 'FEITO']
        )->get();
        if(count($pedidos) > 0 ){
            return view('carrinho.index', compact('pedidos'));
        }else{
            return redirect()->route('home');
        }
        
    }


    public function adicionar(){
        $this->middleware('signed');

        $req = Request();
        $idproduto = $req->input('id');
        $idusuario = Auth::id();

        $produto = Produto::find($idproduto);

        $valor = $produto->price;

        if(empty($produto->id)){
            $req->session()->flash('Mensagem-falha', 'Não tem esse');
            return redirect()->route('carrinho.index');
        }

        $idpedido = Pedido::consultaId([
            'users_id' => $idusuario,
            'status' => 'FEITO'
        ]);

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
            'valor' => $valor,
            'status' => 'FEITO'
        ]);

        $req->session()->flash('mensagem-sucesso', "Adding");
        return redirect()->route('carrinho.index');

    }

    public function deletar(){
        $this->middleware('signed');

        $req = Request();
        $idpedido = $req->input('pedido_id');
        $idproduto = $req->input('produto_id');
        $remove_apenas_item = (boolean)$req->input('item');
        $idusuario = Auth::id();

        $idpedido = Pedido::consultaId([
            'id' => $idpedido,
            'users_id' => $idusuario,
            'status' => 'FEITO'
        ]);

        if(empty($idpedido)){
            $req->session()->flash('mensagem-falha');
            return redirect()->route('carrinho.index');
        }

        $where_produto = [
            'pedido_id' => $idpedido,
            'produto_id' => $idproduto
        ];

        $produto = PedidoProduto::where($where_produto)->orderBy('id', 'desc')->first();
        if(empty($produto->id)){
            $req->session()->flash('mensagem-falha');
            return redirect()->route('carrinho.index');
        }

        if($remove_apenas_item){
            $where_produto['id'] = $produto->id;
        }

        PedidoProduto::where($where_produto)->delete();

        $check_pedido = PedidoProduto::where([
            'pedido_id' => $produto->pedido_id
        ])->exists();

        if(!$check_pedido){
            Pedido::where([
                'pedido_id' => $produto->pedido_id
            ])->delete();
        }

        $req->session()->flash('mensagem-sucesso');

        return redirect()->route('carrinho.index');
    }

    public function concluir(){

        $req = Request();
        $idpedido = $req->input('pedido_id');
        $total = $req->input('total');
        $number = $req->input('number');
        $cvv = $req->input('cvv');
        $cpf = $req->input('cpf');
        $type = $req->input('type');
        $idusuario = Auth::id();

        $check_pedido = Pedido::where([
            'id' => $idpedido,
            'users_id' => $idusuario,
            'status' => 'FEITO'
        ])->exists();

        if(!$check_pedido){
            $req->session()->flash('mensagem-falha');
            return redirect()->route('carrinho.index');
        }

        PedidoProduto::where([
            'pedido_id' => $idpedido
        ])->update([
            'status' => 'FINALIZADO'
        ]);
        Pedido::where([
            'id' => $idpedido
        ])->update([
            'total' => $total,
            'cvv' => $cvv,
            'number' => $number,
            'cpf' => $cpf,
            'type' => $type,
            'status' => 'FINALIZADO'
        ]);

        Cupom::create([
            'email' => $idusuario,
            'valor' => ($total*0.1)
        ]);

        $req->session()->flash('mensagem-sucesso');

        return redirect()->route('carrinho.index');
    }

    public function compras(){
       $compras = Pedido::where([
        'status' => 'FINALIZADO',
        'users_id' => Auth::id()
       ])->get();

       echo $compras;
    }
}
