@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12 mt-2">
            <div class="pull-left">
                <h2>Editar Quincena</h2>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>ERROR</strong> Hubo problemas con tus datos.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($quincena, ['method'=>'PATCH','route'=>['quincenas.update',$quincena->id]]) !!}
        <a href="{{route('quincenas.index')}}" class="btn btn-primary">Volver</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
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
                    <td class="col-sm-4">{!! Form::number("ingresos[$i]", $quincena->ingresos[$i],['min' => '0' ,'step' => '0.01','class' => 'form-control form-control-sm','required', 'style' => 'text-align: right']) !!}</td>
                    <td class="col-sm-4">{!! Form::number("egresos[$i]", $quincena->egresos[$i],['min' => '0', 'step' => '0.01','class' => 'form-control form-control-sm','required', 'style' => 'text-align: right']) !!}</td>
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
    {!! Form::close() !!}
@endsection