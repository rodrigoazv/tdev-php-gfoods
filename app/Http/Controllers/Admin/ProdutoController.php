<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produto;

class ProdutoController extends Controller
{

    private $objFood;

    public function __construct(){
            $this->objFood = new Produto();
    }

    public function create()
    {
        return view('cadprod');
    }
    public function index(){
        $food = $this->objFood->all();
        return view('allprods', compact('food'));
    }
    
    public function delete(){
        $req = Request();
        $idproduto = $req->input('produto_id');
        $where_produto = [
            'id' => $idproduto
        ];
        $produto = Produto::where($where_produto)->orderBy('id', 'desc')->first();
        echo $produto;
        Produto::where([
            'id' => $produto->id
        ])->delete();

        $req->session()->flash('mensagem-sucesso');

        return redirect()->route('allprod.index');
    }

    public function update(){
        $req = Request();
        $idproduto = $req->input('produto_id');
        $where_produto = [
            'id' => $idproduto
        ];
        $produto = Produto::where($where_produto)->orderBy('id', 'desc')->first();
        echo $produto;
        Produto::where([
            'id' => $produto->id
        ])->delete();

        $req->session()->flash('mensagem-sucesso');

        return redirect()->route('allprod.index');
    }

    public function store(Request $request)
    {
    
        $cad = $this->objFood->create([
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'foto'=>$request->foto,
            'type'=>$request->type,
        ]);
        if($cad){
            return redirect('home');
        }
    }
}
