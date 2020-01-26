@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Iot Dispositivo
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($iotDevice, ['route' => ['iotDevices.update', $iotDevice->id], 'method' => 'patch']) !!}

                        @include('iot_devices.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
