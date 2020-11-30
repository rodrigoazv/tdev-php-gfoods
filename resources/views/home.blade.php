@extends('layouts.app')

@section('content')
<div class="container">
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
