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

    public function user(){
        return $this->belongsTo('App\User');
    }
}
