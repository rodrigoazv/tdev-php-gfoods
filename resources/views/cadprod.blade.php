@extends('layouts.app')

@section('content')
<div class="container">
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
        <div>
        <form style="margin-top:20px" name="formCad" id="formCad" method="post" action="{{route('produto.store')}}">
         @csrf
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Nome do produto</label>
            <input type="text" class="form-control" id="name"  name="name" placeholder="Salada de alface" required>
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Preço</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="1.20" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputAddress">Descrição</label>
          <input type="textarea" class="form-control" id="description" name="description" required placeholder="Salada de alface pura sem maionese">
        </div>
        <div class="form-group">
          <label for="inputAddress">URL FOTO</label>
          <input type="textarea" class="form-control" id="foto" name="foto" required placeholder="http foto">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEstado">Categoria</label>
            <select id="inputEstado" class="form-control" required>
              <option selected>Comida</option>
              <option>Bebida</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck" required>
            <label class="form-check-label" for="gridCheck">
              Confirmo que tudo está correto
            </label>
          </div>
        </div>
        <input type="submit" class="btn btn-primary"/>
      </form>
        </div>
    @endif
</div>
@endsection
