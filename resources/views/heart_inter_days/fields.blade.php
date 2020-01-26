<!-- fecha inicio Field -->
<div class="form-group col-sm-12">
        {!! Form::label('dateStart', 'Fecha Comienzo:') !!}
        {{ Form::date('dateStart', $startDate ) }}

    </div>

    <!-- fecha fin Field
    <div class="form-group col-sm-6">
        {!! Form::label('dateEnd', 'Fecha Fin:') !!}
        {{ Form::date('dateEnd', $endDate) }}

    </div>-->

    <!--  Local Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('user_id', 'Usuario:') !!}
        {{ Form::select('user_id', $fitbitUser, ['class' => 'form-control']) }}
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Consultar', ['class' => 'btn btn-primary']) !!}
    </div>

