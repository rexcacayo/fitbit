@extends('layouts.app')
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
                <div class="row" style="padding: 15px;">
                    @include('notifies.show_fields')
                    <a href="{!! route('notifies.index') !!}" class="btn btn-primary top">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
