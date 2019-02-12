<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuincenaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dia_init = date('Y/m/d');
        $dias = array();
        $ingresos = array();
        $egresos = array();
        $total_dias = array();
        $totales = array();
        $dia_format = date_create($dia_init);

        $divisor = pow(10, 2);
        for ($i=0; $i < 14; $i++) { 
            $dias[] = date_format($dia_format, 'Y/m/d');
            $ingresos[] = mt_rand(150, 300 * $divisor) / $divisor;
            $egresos[] = mt_rand(0, 100 * $divisor) / $divisor;
            $total_dias[] = $ingresos[$i] - $egresos[$i];
            date_add($dia_format, new DateInterval('P1D'));
        }
        $totales = [
            'ingresos' => array_sum($ingresos),
            'egresos' => array_sum($egresos),
            'total' => array_sum($ingresos) - array_sum($egresos),
        ];
        DB::Table('quincenas')->insert([
            'user_id' => 1,
            'fecha_inicial' => $dia_init,
            'dias' => json_encode($dias),
            'ingresos' => json_encode($ingresos),
            'egresos' => json_encode($egresos),
            'total_dias' => json_encode($total_dias),
            'totales' => json_encode($totales),
        ]);
    }
}
