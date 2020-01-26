@extends('layouts.app')

@section('content')

    <section class="content-header flexInput">
            @include('flash::message')
            <div class="headerInput vCenter">

                    <h1>Lectura de Temeperatura</h1>
                </div>

    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row formInput">
                    {!! Form::open(['route' => 'temperatura.consulta', 'class'=> 'formQuery']) !!}

                        @include('temperatura.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
