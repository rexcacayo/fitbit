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

@media (max-width: 888px) {
    .content .box {
        width: 66vw !important;
        margin-left: 12vw !important;
    }

    .flexInput {
        width: 74vw !important;
        margin-left: 12vw;
        padding-top: 6vw;
    }
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
                <div class="row" style="padding: 15px;">
                    @include('iot_services.show_fields')
                    <a href="{!! route('iotServices.index') !!}" class="btn btn-primary top">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
