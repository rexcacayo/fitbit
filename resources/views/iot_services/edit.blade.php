@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Iot Service
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($iotService, ['route' => ['iotServices.update', $iotService->id], 'method' => 'patch']) !!}

                        @include('iot_services.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection