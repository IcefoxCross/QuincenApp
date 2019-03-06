@extends('layouts.default')
@section('content')
    <div class="row text-center">
        <div class="col-lg-12 my-3">
            <div class="pull-left">
                <h2>Nueva Quincena</h2>
            </div>
            <div class="pull-right">
                <a href="{{route('quincenas.index')}}" class="btn btn-primary">Volver</a>
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
    <br>
    {!! Form::open(array('route'=>'quincenas.store','method'=>'POST')) !!}
        @include('quincena.form')
    {!! Form::close() !!}
@endsection