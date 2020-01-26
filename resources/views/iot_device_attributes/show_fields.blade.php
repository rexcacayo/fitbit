<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $iotDeviceAttribute->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $iotDeviceAttribute->name !!}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{!! $iotDeviceAttribute->type !!}</p>
</div>

<!-- Entity Id Field -->
<div class="form-group">
    {!! Form::label('entity_id', 'Entity Id:') !!}
    <p>{!! $iotDeviceAttribute->entity_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $iotDeviceAttribute->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $iotDeviceAttribute->updated_at !!}</p>
</div>

