<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Quincena;
use DateTime;
use DatePeriod;
use DateInterval;

class QuincenaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quincenas = Quincena::latest()->paginate(10);
        return view('quincena.index', compact('quincenas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quincena.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha_inicial' => 'required',
        ]);
        // Tablas
        $dias = array();
        $ingresos = array();
        $egresos = array();
        $total_dias = array();
        $totales = array();
        $dia_format = date_create($request->fecha_inicial);
        // Generando datos en tablas
        for ($i=0; $i < 14; $i++) { 
            $dias[] = date_format($dia_format, 'Y/m/d');
            $ingresos[] = 0.0;
            $egresos[] = 0.0;
            $total_dias[] = $ingresos[$i] - $egresos[$i];
            date_add($dia_format, new DateInterval('P1D'));
        }
        $totales = [
            'ingresos' => array_sum($ingresos),
            'egresos' => array_sum($egresos),
            'total' => array_sum($ingresos) - array_sum($egresos),
        ];
        // Asignando tablas
        $quincena = Quincena::create([
            'fecha_inicial' => $request->fecha_inicial,
            'user_id' => 1,
            'dias' => $dias,
            'ingresos' => $ingresos,
            'egresos' => $egresos,
            'total_dias' => $total_dias,
            'totales' => $totales,
        ]);
        $quincena->save();
        return redirect()->route('quincenas.index')->with('success', 'Quincena creada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $q = Quincena::find($id);
        return view('quincena.show', array('quincena' => $q));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $q = Quincena::find($id);
        return view('quincena.edit', array('quincena' => $q));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $q = Quincena::find($id);
        $ingresos = array();
        $egresos = array();
        $total_dias = array();
        $totales = array();
        for ($i=0; $i < 14; $i++) { 
            $ingresos[] = (float)$request->ingresos[$i];
            $egresos[] = (float)$request->egresos[$i];
            $total_dias[] = $ingresos[$i] - $egresos[$i];
        }
        $totales = [
            'ingresos' => array_sum($ingresos),
            'egresos' => array_sum($egresos),
            'total' => array_sum($ingresos) - array_sum($egresos),
        ];
        $q->ingresos = $ingresos;
        $q->egresos = $egresos;
        $q->total_dias = $total_dias;
        $q->totales = $totales;
        $q->save();
        return redirect()->route('quincenas.index')->with('success', 'Quincena actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Quincena::destroy($id);
        return redirect()->route('quincenas.index')->with('success', 'Quincena eliminada con éxito.');
    }
}
