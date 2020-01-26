<!-- Id Field
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $iotDevice->id !!}</p>
</div>-->

<!-- Ipserver Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ipServer', 'Servidor Fiware:') !!}
    <p>{!! $iotDevice->ipServer !!}</p>
</div>

<!-- Fiwareservice Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fiwareService', 'Base de datos:') !!}
    <p>{!! $iotDevice->fiwareService !!}</p>
</div>

<!-- Fiwarepath Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fiwarePath', 'Nombre de spa:') !!}
    <p>{!! $iotDevice->fiwarePath !!}</p>
</div>

<!-- Device Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('device_id', 'Id Dispositivo:') !!}
    <p>{!! $iotDevice->device_id !!}</p>
</div>

<!-- Entity Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('entity_name', 'Nombre del dispositivo:') !!}
    <p>{!! $iotDevice->entity_name !!}</p>
</div>

<!-- Entity Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('entity_type', 'Conjunto de datos:') !!}
    <p>{!! $iotDevice->entity_type !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-12">
    {!! Form::label('created_at', 'Creación:') !!}
    <p>{!! $iotDevice->created_at !!}</p>
</div>

<!-- Updated At Field
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $iotDevice->updated_at !!}</p>
</div>-->

