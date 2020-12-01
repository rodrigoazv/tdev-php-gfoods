@extends('layouts.app')

@section('content')
<div class="container">
        @if(Session::has('mensagem-sucesso'))
            <h1>Message</h1>
        @endif
        @if(Session::has('Mensagem-falha'))
            <h1>Message</h1>
        @endif
    @if (Auth::user()->name == 'admin')
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
            <ul class="nav nav-pills nav-fill" style="width: 100%">
                <li class="nav-item" style="padding: 0 10px;">
                    <a class="nav-link " href="/cozinha">Cozinha</a>
                </li>
                <li class="nav-item " style="padding: 0 10px;">
                    <a class="nav-link  " href="/cadprod">Cadastrar produto</a>
                </li>
                <li class="nav-item" style="padding: 0 10px;">
                    <a class="nav-link  " href="/promocoes">Teste</a>
                </li>
                <li class="nav-item" style="padding: 0 10px;">
                    <a class="nav-link  " href="/pedidos" tabindex="-1" >Pedidos todos</a>
                </li>
                </ul>
            </div>
        </nav>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Comidas') }}</div>

                <div class="card-body" style="display: flex">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($food as $foods)
                    <div class="card" style="width: 18rem; margin: 10px">
                        <img class="card-img-top" src="https://www.receiteria.com.br/wp-content/uploads/receitas-de-suco.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Nome: {{$foods->name}}</h5>
                            <p class="card-text">Descrição : {{$foods->description}}</p>
                            <p class="card-text">R$ {{$foods->price}}</p>
                            <form method="POST" action="{{route('carrinho.adicionar')}}">
                            @csrf
                                <input type='hidden' name='id' value="{{$foods->id}}"/>
                                <button class="btn btn-success">Adicioanr</button>
                            </form>
                        </div>
                    </div>
                    @endforeach()

                </div>
               
                    <div class="card-header">{{ __('Bebidas') }}</div>
                    
                    <div class="card-body" style="display: flex">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @foreach($food as $foods)
                        <div class="card" style="width: 18rem; margin: 10px">
                            <img class="card-img-top" src="https://www.receiteria.com.br/wp-content/uploads/receitas-de-suco.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Nome: {{$foods->name}}</h5>
                                <p class="card-text">Descrição : {{$foods->description}}</p>
                                <p class="card-text">R$ {{$foods->price}}</p>
                                <form method="POST" action="{{route('carrinho.adicionar')}}">
                                @csrf
                                    <input type='hidden' name='id' value="{{$foods->id}}"/>
                                    <button class="btn btn-success">Adicioanr</button>
                                </form>
                            </div>
                        </div>  
                        @endforeach()

               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
