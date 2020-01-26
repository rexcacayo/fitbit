<!-- Token Field -->
<div class="form-group col-sm-6">
    {!! Form::label('token', 'Token:') !!}
    {!! Form::text('token', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Datebirth Field -->
<div class="form-group col-sm-6">
    {!! Form::label('datebirth', 'Datebirth:') !!}
    {!! Form::date('datebirth', null, ['class' => 'form-control','id'=>'datebirth']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#datebirth').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Age Field -->
<div class="form-group col-sm-6">
    {!! Form::label('age', 'Age:') !!}
    {!! Form::text('age', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('fitbits.index') !!}" class="btn btn-default">Cancel</a>
</div>
