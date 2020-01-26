@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="headerTable">
            <h1 class="pull-left txtH1">Lista</h1>
            <h1 class="pull-right">
                <a class="forma pull-right" style="margin-right:10px" href="{!! route('notifies.create') !!}">+</a>
            </h1>
        </div>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('notifies.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

