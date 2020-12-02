<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    protected $table='cupoms';
    protected $fillable=['email', 'valor'];
}
