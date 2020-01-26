<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $entity->id !!}</p>
</div>

<!-- Ipserver Field -->
<div class="form-group">
    {!! Form::label('ipServer', 'Ip Server:') !!}
    <p>{!! $entity->ipServer !!}</p>
</div>

<!-- Fiwareservice Field -->
<div class="form-group">
    {!! Form::label('fiwareService', 'Fiware Service:') !!}
    <p>{!! $entity->fiwareService !!}</p>
</div>

<!-- Fiwarepath Field -->
<div class="form-group">
    {!! Form::label('fiwarePath', 'Fiware Path:') !!}
    <p>{!! $entity->fiwarePath !!}</p>
</div>

<!-- Entityid Field -->
<div class="form-group">
    {!! Form::label('entityID', 'Entity Id:') !!}
    <p>{!! $entity->entityID !!}</p>
</div>

<!-- Typeentity Field -->
<div class="form-group">
    {!! Form::label('typeEntity', 'Type Entity:') !!}
    <p>{!! $entity->typeEntity !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $entity->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $entity->updated_at !!}</p>
</div>

