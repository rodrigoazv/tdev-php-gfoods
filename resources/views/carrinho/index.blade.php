@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    @forelse($pedidos as $pedido)
                    <h1>{{$pedido->id}}</h1>
                    @empty
                        <h1>Nenhum</h1>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
