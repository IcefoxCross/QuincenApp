@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>Quincenas</h2>
            </div>
            <div class="pull-right my-4">
                <a href="{{route('quincenas.create')}}" class="btn btn-success">Nueva Quincena</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>Fecha Inicio</th>
            <th>Fecha Final</th>
            <th>Total</th>
            <th width="280px"></th>
        </tr>
        @foreach ($quincenas as $quincena)
            <tr>
                <td>{{date('d/m/y',strtotime($quincena->fecha_inicial))}}</td>
                <td>{{date('d/m/y',strtotime($quincena->fecha_final()))}}</td>
                <td>$ {{$quincena->totales['total']}}</td>
                <td>
                    <a href="{{route('quincenas.show', $quincena->id)}}" class="btn btn-info">Ver</a>
                    <a href="{{route('quincenas.edit', $quincena->id)}}" class="btn btn-primary">Editar</a>
                    {!! Form::open(['method'=>'DELETE','route'=>['quincenas.destroy',$quincena->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Eliminar', ['class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
    {!! $quincenas->render() !!}
@endsection