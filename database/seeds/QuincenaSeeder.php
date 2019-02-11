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
        $dia_format = date_create($dia_init);
        for ($i=0; $i < 14; $i++) { 
            $dias[] = date_format($dia_format, 'Y/m/d');
            //$dia = strtotime("+1 day", $dia);
            date_add($dia_format, new DateInterval('P1D'));
        }
        DB::Table('quincenas')->insert([
            'fecha_inicial' => $dia_init,
            'dias' => json_encode($dias),
        ]);
    }
}
