<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quincena extends Model
{
    protected $casts = [
        'dias' => 'array',
        'ingresos' => 'array',
        'egresos' => 'array',
        'total_dias' => 'array',
        'totales' => 'array',
    ];

    protected $fillable = [
        'fecha_inicial',
        'user_id',
        'dias',
        'ingresos',
        'egresos',
        'total_dias',
        'totales',
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function fecha_final(){
        return $this->dias[13];
    }
}
