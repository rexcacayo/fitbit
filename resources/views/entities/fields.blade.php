<!-- Ipserver Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ipServer', 'Ip server:') !!}
    {!! Form::text('ipServer', null, ['class' => 'form-control']) !!}
</div>

<!-- Fiwareservice Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fiwareService', 'Fiware Service:') !!}
    {!! Form::text('fiwareService', null, ['class' => 'form-control']) !!}
</div>

<!-- Fiwarepath Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fiwarePath', 'Fiware Path:') !!}
    {!! Form::text('fiwarePath', null, ['class' => 'form-control']) !!}
</div>

<!-- Entityid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('entityID', 'Entity Name:') !!}
    {!! Form::text('entityID', null, ['class' => 'form-control']) !!}
</div>

<!-- Typeentity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('typeEntity', 'Type Entity:') !!}
    {!! Form::text('typeEntity', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    <p><strong>Atribute Entity</strong></p>
    <button type="button" class="btn btn-primary" id="agregarAttr">Add New Attribute</button>
    <div id="attr" class="containerFlexAttr">
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('entities.index') !!}" class="btn btn-default">Cancel</a>
</div>
