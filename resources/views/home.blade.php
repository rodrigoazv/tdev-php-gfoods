@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($food as $foods)
                    <div class="card" style="width: 18rem; margin: 10px">
                        <img class="card-img-top" src="https://www.receiteria.com.br/wp-content/uploads/receitas-de-suco.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$foods->name}}</h5>
                            <p class="card-text">{{$foods->description}}</p>
                            <p class="card-text">{{$foods->price}}</p>
                            <a href="#" class="btn btn-primary">Adicionar ao Pedido</a>
                        </div>
                    </div>
                    @endforeach()

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
