<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table='pedidos';
    protected $fillable=['id'];

    public function pedido_produtos(){
        return $this->hasMany('App\PedidoProduto')->select(\DB::raw('produto_id, sum(valor) as valores'))->groupBy('produto_id');
    }

    public static function consultaId($where){
        $pedido = self::where($where)->first(['id']);
        return !empty($pedido->id) ? $pedido->id : null;
    }
}
