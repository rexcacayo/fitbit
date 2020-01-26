<style>
        .content .box{
            width:21.45vw !important;
            margin-left: 32vw;
        }

        .flexInput {
            width: 23vw !important;
            margin-left: 32vw;
            padding-top: 6vw;
        }


        </style>
@extends('layouts.app')

@section('content')
<section class="content-header flexInput">
        <div class="headerInput vCenter">
            <h1>
                Ver
            </h1>
        </div>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body formInput">
                <div class="row" style="padding-left: 20px">
                    @include('iot_devices.show_fields')
                    <a href="{!! route('iotDevices.index') !!}" class="btn btn-primary top">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
