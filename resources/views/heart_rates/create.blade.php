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
                    {!! Form::open(['route' => 'heartRates.store']) !!}

                        @include('heart_rates.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
