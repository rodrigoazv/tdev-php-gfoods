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
            @php
                $total_pedido = 0;
            @endphp
                    @forelse($pedidos as $pedido)
                    <h1>Id: #{{$pedido->id}}</h1>
                    @foreach($pedido->pedido_produtos as $pedido_produto)
                    <div style="border-bottom: 5px solid #f4f4f4">
                        <div>{{$pedido_produto->produto->name}}</div>
                        <div>Já está na cozinha</div>
                       <div style="display: flex">
                        <form id="form-remover-produto" method="POST" action="{{route('carrinho.deletar')}}">
                            @csrf
                            <input type='hidden' name='pedido_id' value="{{$pedido->id}}"/>
                            <input type='hidden' name='produto_id' value="{{$pedido_produto->produto->id}}"/>
                            <input type='hidden' name='item' value="{{ 1 }}"/>
                            <button class="btn btn-outline-danger">-</button>
                        </form>
                        <div style="padding: 6px 20px">{{$pedido_produto->qtd}}</div>
                        <div style="padding: 6px 20px">{{$pedido_produto->valores}}</div>
                        @php
                             $total_pedido += $pedido_produto->valores;
                         @endphp
                        
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
        <div>Total : {{$total_pedido}} </div>
      </div>
      <div class="modal-footer">
        <form  method="POST" style=" margin: auto"action="{{route('carrinho.concluir')}}">
            @csrf
            <input type="hidden" name="pedido_id" value="{{$pedido->id}}">
            <input type="hidden" name="total" value="{{$total_pedido}}">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Numero do cartão</label>
                    <input type="number" class="form-control" id="name"  name="number" placeholder="Cartão numero" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Preço</label>
                    <input type="number" class="form-control" id="cvv" name="cvv" placeholder="cvv" required>
                </div>
                </div>
                <div class="form-group">
                <label for="inputAddress">CPF</label>
                <input type="textarea" class="form-control" id="CPF" name="CPF" required placeholder="CPF do dono">
                </div>
                <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEstado">Categoria</label>
                    <select id="inputEstado" class="form-control" name="type" required>
                    <option selected>Crédito</option>
                    <option>Débito</option>
                    </select>
                </div>
                </div>
            <button class="btn btn-primary btn-lg btn-block">Pagar com cartão</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
