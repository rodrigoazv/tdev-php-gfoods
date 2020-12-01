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

    public function store(Request $request)
    {
    
        $cad = $this->objFood->create([
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'foto'=>$request->foto,
        ]);
        if($cad){
            return redirect('home');
        }
    }
}
