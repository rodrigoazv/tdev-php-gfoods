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
            <div class="card" style="padding: 20px">
                    @forelse($pedidos as $pedido)
                    <h1>Id: #{{$pedido->id}}</h1>
                    @foreach($pedido->pedido_produtos as $pedido_produto)
                    <div style="border-bottom: 5px solid #f4f4f4">
                        <div>{{$pedido_produto->produto->name}}</div>
                        <div style="padding: 6px 20px">PEDIDO {{$pedido->status}}</div>
                       <div style="display: flex">
                        <form id="form-remover-produto" method="POST" action="{{route('carrinho.deletar')}}">
                            @csrf
                            <input type='hidden' name='pedido_id' value="{{$pedido->id}}"/>
                            <input type='hidden' name='produto_id' value="{{$pedido_produto->produto->id}}"/>
                            <input type='hidden' name='item' value="{{ 1 }}"/>
                            <button class="btn btn-outline-danger">-</button>
                        </form>
                        <div style="padding: 6px 20px">{{$pedido_produto->qtd}}</div>
                        
                        <form id="form-remover-produto" method="POST" action="{{route('carrinho.adicionar')}}">
                            @csrf
                            <input type='hidden' name='id' value="{{$pedido_produto->produto->id}}"/>
                            <button class="btn btn-outline-success">+</button>
                        </form>
                        </div>
                        <div style="margin-top: 10px">
                        <form id="form-remover-produto" method="POST" action="{{route('carrinho.deletar')}}">
                            @csrf
                            <input type='hidden' name='pedido_id' value="{{$pedido->id}}"/>
                            <input type='hidden' name='produto_id' value="{{$pedido_produto->produto->id}}"/>
                            <input type='hidden' name='item' value="{{ 0 }}"/>
                            <button class="btn btn-outline-dark">Remover Produto</button>
                        </form>
                        </div>
                    </div>
                    @endforeach()
                    @empty
                        <h1>Nenhum</h1>
                    @endforelse
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                         Fechar conta e escolher forma de pagamento
                    </button>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table table-dark">
        <thead>
            <tr>
            <th scope="col">Nome</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Preço</th>
            </tr>
        </thead>
        <tbody>
        @forelse($pedidos as $pedido)
            @foreach($pedido->pedido_produtos as $pedido_produto)
            <tr>
            
            <td>{{$pedido_produto->produto->name}}</td>
            <td>{{$pedido_produto->qtd}}</td>
            <td>{{$pedido_produto->produto->price * $pedido_produto->qtd}}</td>
           
            </tr>
            @endforeach()
            @empty
                <h1>Nenhum</h1>
            @endforelse
        </tbody>
     </table>
        <div>Desconto :{{$pedido->desconto}} </div>
        <div>Total : {{$pedido_produto->desconto}} </div>
      </div>
      <div class="modal-footer">
        <form  method="POST" action="{{route('carrinho.concluir')}}">
            @csrf
            <input type="hidden" name="pedido_id" value="{{$pedido->id}}">
            <button class="btn btn-primary btn-lg btn-block">Pagar com cartão</button>
        </form>
        <form  method="POST" action="{{route('carrinho.concluir')}}">
            @csrf
            <input type="hidden" name="pedido_id" value="{{$pedido->id}}">
            <button class="btn btn-success btn-lg btn-block">Pagar com dinheiro</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
