@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if(Session::has('mensagem-sucesso'))
            <h1>Message</h1>
        @endif
        @if(Session::has('Mensagem-falha'))
            <h1>Message</h1>
        @endif
            <div class="card">
                    @forelse($pedidos as $pedido)
                    <h1>{{$pedido->id}}</h1>
                    @foreach($pedido->pedido_produtos as $pedido_produto)
                    <div>
                        <div>{{$pedido_produto->produto->name}}</div>
                        <div>{{$pedido_produto->qtd}}</div>
                       
                        <form id="form-remover-produto" method="POST" action="{{route('carrinho.deletar')}}">
                            @csrf
                            <input type='hidden' name='pedido_id' value="{{$pedido->id}}"/>
                            <input type='hidden' name='produto_id' value="{{$pedido_produto->produto->id}}"/>
                            <input type='hidden' name='item' value="{{ 1 }}"/>
                            <button>Remover</button>
                        </form>
                        <form id="form-remover-produto" method="POST" action="{{route('carrinho.adicionar')}}">
                            @csrf
                            <input type='hidden' name='id' value="{{$pedido_produto->produto->id}}"/>
                            <button>Adicionar</button>
                        </form>
                        <form id="form-remover-produto" method="POST" action="{{route('carrinho.deletar')}}">
                            @csrf
                            <input type='hidden' name='pedido_id' value="{{$pedido->id}}"/>
                            <input type='hidden' name='produto_id' value="{{$pedido_produto->produto->id}}"/>
                            <input type='hidden' name='item' value="{{ 0 }}"/>
                            <button>Remover Produto</button>
                        </form>
                    </div>
                    @endforeach()
                    @empty
                        <h1>Nenhum</h1>
                    @endforelse
                    <form  method="POST" action="{{route('carrinho.concluir')}}">
                        @csrf
                        <input type="hidden" name="pedido_id" value="{{$pedido->id}}">
                        <button>CONCLUIR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="form-adicionar-produto" method="POST" action="{{route('carrinho.adicionar')}}">
    @csrf
    <input type='hidden' name='produto_id'/>
</form>
@endsection
