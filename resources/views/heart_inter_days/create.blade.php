@extends('layouts.app')

@section('content')
    <section class="content-header flexInput">
            <div class="headerInput vCenter">

                    <h1>Zonas de Consulta</h1>
                </div>

    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row formInput">
                    {!! Form::open(['route' => 'heartInterDays.store']) !!}

                        @include('heart_inter_days.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
