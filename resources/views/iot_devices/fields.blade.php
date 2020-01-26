<!-- Ipserver Field
<div class="form-group col-sm-6">
    {!! Form::label('ipServer', 'Servidor Fiware:') !!}
    {!! Form::text('ipServer', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Fiwareservice Field
<div class="form-group col-sm-6">
    {!! Form::label('fiwareService', 'Base de datos:') !!}
    {!! Form::text('fiwareService', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Fiwarepath Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fiwarePath', 'Nivel de Datos:') !!}
    {{ Form::select('fiwarePath', $spa, '', ['class' => 'form-control']) }}
</div>

<!-- Device Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('device_id', 'Número del dispositivo:') !!}
    {{ Form::select('device_id', $userId, '', ['class' => 'form-control']) }}
</div>

<!-- Entity Name Field
<div class="form-group col-sm-6">
    {!! Form::label('entity_name', 'Nombre del dispositivo:') !!}
    {!! Form::text('entity_name', null, ['class' => 'form-control']) !!}
</div>-->

<!-- Entity Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('entity_type', 'Conjunto de datos:') !!}
    {{ Form::select('entity_type', $conjunto, '', ['class' => 'form-control']) }}
</div>

<!--<div class="form-group col-sm-12">
    <p><strong>Parámetros de Sensor</strong></p>
    <button type="button" class="btn btn-primary" id="agregarAttr">Agregar Parámetros</button>
    <div id="attr" class="containerFlexAttr">
    </div>
</div>-->

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Crear', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('iotDevices.index') !!}" class="btn btn-default">Cancelar</a>
</div>
