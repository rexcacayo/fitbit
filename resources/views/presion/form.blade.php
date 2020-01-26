@extends('layouts.app')

@section('content')

    <section class="content-header flexInput">
            @include('flash::message')
            <div class="headerInput vCenter">
                    <h1>Lectura de Presión</h1>
                </div>

    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary formulario">

            <div class="box-body">
                <div class="row formInput">
                    {!! Form::open(['route' => 'presion.consultaPresion', 'class'=> 'formQuery']) !!}

                        @include('presion.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
