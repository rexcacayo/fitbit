@extends('layouts.app')

@section('content')
<section class="content-header flexInput">
        <div class="headerInput vCenter">
            <h1>Dar de Alta</h1>
        </div>

    <div class="content">
        @include('adminlte-templates::common.errors')
        @include('flash::message')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row formInput">
                    {!! Form::open(['route' => 'iotDevices.store']) !!}

                        @include('iot_devices.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
