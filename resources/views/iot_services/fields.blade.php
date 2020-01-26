<!-- ipServer Field
<div class="form-group col-sm-6">
    {!! Form::label('ipServer', 'Servidor Fiware:') !!}
    {!! Form::text('ipServer', null, ['class' => 'form-control']) !!}
</div>-->

<!-- Fiwareservice Field
<div class="form-group col-sm-6">
    {!! Form::label('fiwareService', 'Base de datos:') !!}
    {!! Form::text('fiwareService', null, ['class' => 'form-control']) !!}
</div>-->

<!-- Fiwarepath Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fiwarePath', 'Nivel de Dato:') !!}
    {!! Form::text('fiwarePath', $fiwarepath, ['class' => 'form-control','readonly']) !!}
</div>

<!-- Apikey Field -->
<div class="form-group col-sm-6">
    {!! Form::label('apikey', 'Apikey:') !!}
    {!! Form::text('apikey', null, ['class' => 'form-control']) !!}
</div>

<!-- Entity Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('entity_type', 'Conjunto de datos:') !!}
    {!! Form::text('entity_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Resource Field-->
<div class="form-group col-sm-6">
    {!! Form::label('resource', 'End point:') !!}
    {!! Form::text('resource', $resource, ['class' => 'form-control','readonly']) !!}
</div>

<div class="form-group col-sm-12">
    <p><strong>Parámetros de Sensor</strong></p>
    <button type="button" class="btn btn-primary" id="agregarAttr">Agregar Parámetros</button>
    <div id="attr" class="containerFlexAttr">
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-6 top">
    {!! Form::submit('Crear', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('iotServices.index') !!}" class="btn btn-default">Cancelar</a>
</div>
