@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if(Session::has('mensagem-sucesso'))
            <h1>tem essa porra</h1>
        @endif
        @if(Session::has('Mensagem-falha'))
            <h1>tem essa porra</h1>
        @endif
            <div class="card">
                    @forelse($pedidos as $pedido)
                    <h1>{{$pedido->id}}</h1>
                    @foreach($pedido->pedido_produtos as $pedido_produto)
                        <div>{{$pedido_produto->produto->name}}</div>
                        <div>{{$pedido_produto->qtd}}</div>
                    @endforeach()
                    @empty
                        <h1>Nenhum</h1>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
