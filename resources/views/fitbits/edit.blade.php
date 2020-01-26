@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Fitbit
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($fitbit, ['route' => ['fitbits.update', $fitbit->id], 'method' => 'patch']) !!}

                        @include('fitbits.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection