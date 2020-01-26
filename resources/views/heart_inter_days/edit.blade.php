@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Heart Inter Day
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($heartInterDay, ['route' => ['heartInterDays.update', $heartInterDay->id], 'method' => 'patch']) !!}

                        @include('heart_inter_days.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection