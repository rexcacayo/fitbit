<!-- Id Field
<div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $notify->id !!}</p>
</div>-->

<!-- Ipserver Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ipServer', 'Servidor Fiware:') !!}
    <p>{!! $notify->ipServer !!}</p>
</div>

<!-- Fiwareservice Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fiwareService', 'Base de datos:') !!}
    <p>{!! $notify->fiwareService !!}</p>
</div>

<!-- Fiwarepath Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fiwarePath', 'Nombre del puerto:') !!}
    <p>{!! $notify->fiwarePath !!}</p>
</div>

<!-- Type Field-->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Conjunto de datos:') !!}
    <p>{!! $notify->type !!}</p>
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Descripción:') !!}
    <p>{!! $notify->description !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-12">
    {!! Form::label('created_at', 'Creación:') !!}
    <p>{!! $notify->created_at !!}</p>
</div>

<!-- Updated At Field
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $notify->updated_at !!}</p>
</div>-->

