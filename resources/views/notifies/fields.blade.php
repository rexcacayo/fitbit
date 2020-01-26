<!-- ipServerField
<div class="form-group col-sm-6">
    {!! Form::label('ipServer', 'Servidor Fiware:') !!}
    {!! Form::text('ipServer', null, ['class' => 'form-control']) !!}
</div>-->

<!-- fiwareServiceField
<div class="form-group col-sm-6">
    {!! Form::label('fiwareService', 'Base de datos:') !!}
    {!! Form::text('fiwareService', null, ['class' => 'form-control']) !!}
</div>-->

<!-- fiwarepathField -->
<div class="form-group col-sm-6">
    {!! Form::label('fiwarePath', 'Nombre del puerto:') !!}
    {{ Form::select('fiwarePath', $spa, '', ['class' => 'form-control']) }}
</div>

<!-- typeField -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Conjunto de datos:') !!}
    {{ Form::select('type', $conjunto, '', ['class' => 'form-control']) }}
</div>

<!-- descriptionField -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descripción:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Crear', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('notifies.index') !!}" class="btn btn-default">Cancelar</a>
</div>
