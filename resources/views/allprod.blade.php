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
                    <a class="nav-link  " href="/allprod">Todos os produtos</a>
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
                </td>
            </tr>
        @endforeach()
        </tbody>
        </table>
    @endif
</div>
@endsection
