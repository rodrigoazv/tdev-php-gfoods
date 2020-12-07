<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use Illuminate\Support\Facades\Auth;
use App\Cupom;

class HomeController extends Controller
{
    private $objFood;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->objFood = new Produto();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $idusuario = Auth::id();

        $cupom = Cupom::where([
            'email' => $idusuario
        ])
        ->orderBy('created_at', 'desc')
        ->get();
        
        $food = $this->objFood->all();
        return view('home', compact('food', 'cupom'));
    }
}
