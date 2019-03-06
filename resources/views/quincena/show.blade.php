@extends('layouts.default')

@section('content')
    <a href="{{route('quincenas.index')}}" class="btn btn-primary mt-3">Volver</a>
    <h1>{{date('d/m/y',strtotime($quincena->fecha_inicial))}} - {{date('d/m/y',strtotime($quincena->dias[13]))}}</h1>
    <table>
        <tr>
            <th>Fecha</th>
            <th>Ingresos</th>
            <th>Egresos</th>
            <th>Total</th>
        </tr>
        @for ($i = 0; $i < 14; $i++)
            <tr>
                <td>{{date('d.m.y',strtotime($quincena->dias[$i]))}}</td>
                <td>{{$quincena->ingresos[$i]}}</td>
                <td>{{$quincena->egresos[$i]}}</td>
                <td>{{$quincena->total_dias[$i]}}</td>
            </tr>
        @endfor
        <tr>
            <th>TOTAL:</th>
            <td>{{$quincena->totales['ingresos']}}</td>
            <td>{{$quincena->totales['egresos']}}</td>
            <td>{{$quincena->totales['total']}}</td>
        </tr>
    </table>
@endsection
