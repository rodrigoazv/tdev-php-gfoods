@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if(Session::has('mensagem-sucesso'))
            <h1>Sucesso</h1>
        @endif
        @if(Session::has('Mensagem-falha'))
            <h1>Sem sucesso</h1>
        @endif
            <div class="card p-3">
                
                    @forelse($pedidos as $pedido)
                  
                    <h1>Pedido de numero {{$pedido->id}}</h1>
                    <h3>Status {{$pedido->status}}</h3>
                        @foreach($pedido->pedido_produtos_s as $pedido_produto)
                        <div style="border-bottom: 1px solid #f4f4f4">
                            <div>Nome do produto :{{$pedido_produto->produto->name}}</div>
                            <div>Quantidade: {{$pedido_produto->qtd}} </div>
                            <div>Quantidade: {{$pedido_produto->status}} </div>
                        </div>
                        @endforeach()
                    <form  method="POST" action="{{route('cozinha.preparando')}}">
                        @csrf
                        <input type="hidden" name="pedido_id" value="{{$pedido->id}}">
                        @if($pedido_produto->status == "FEITO")
                            <button class="btn btn-primary">MODO PREPARO</button>
                        @endif
                        @if($pedido_produto->status == "PREPARO")
                            <button class="btn btn-warning">SENDO PREPARADO</button>
                        @endif

                    </form>
                    @empty
                        <h1>Nenhum</h1>             
                    
                    @endforelse
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
