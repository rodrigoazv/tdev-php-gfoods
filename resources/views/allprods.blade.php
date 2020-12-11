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
                    <a class="nav-link  " href="/allprods">Todos os produtos</a>
                </li>
                </ul>
            </div>  
        </nav>
        <div>
         <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Preço</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
        <tbody>
        @foreach($food as $foods)
            <tr>
                <th scope="row">{{$foods->id}}</th>
                <td>{{$foods->name}}</td>
                <td>{{$foods->description}}</td>
                <td>{{$foods->price}}</td>
                <td style="display: flex">
                    <form id="form-remover-produto" method="POST" action="{{route('allprod.delete')}}">
                            @csrf
                            <input type='hidden' name='produto_id' value="{{$foods->id}}"/>
                            <button class="btn btn-outline-danger">X</button>
                    </form>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                         Editar
                    </button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar produto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form id="form-remover-produto" method="POST" action="{{route('allprod.update')}}">
                                @csrf
                                <input type='hidden' name='produto_id' value="{{$foods->id}}"/>
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
                                    <button class="btn btn-outline-warning">Editar</button>
                            </form>  
                            </div>
            
                            </div>
                        </div>
                    </div>
                             
                    
                </td>
            </tr>
        @endforeach()
        </tbody>
        </table>
    @endif
</div>
@endsection
