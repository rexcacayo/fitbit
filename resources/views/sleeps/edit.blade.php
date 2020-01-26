@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Sleep
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($sleep, ['route' => ['sleeps.update', $sleep->id], 'method' => 'patch']) !!}

                        @include('sleeps.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection