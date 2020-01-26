@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Atribute
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($atribute, ['route' => ['atributes.update', $atribute->id], 'method' => 'patch']) !!}

                        @include('atributes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection