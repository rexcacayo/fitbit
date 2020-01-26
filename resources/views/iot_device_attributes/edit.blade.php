@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Iot Device Attribute
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($iotDeviceAttribute, ['route' => ['iotDeviceAttributes.update', $iotDeviceAttribute->id], 'method' => 'patch']) !!}

                        @include('iot_device_attributes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection