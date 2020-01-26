<!-- fecha inicio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dateStart', 'Fecha Comienzo:') !!}
    {{ Form::date('dateStart', \Carbon\Carbon::now()) }}

</div>

<!-- fecha fin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dateEnd', 'Fecha Fin:') !!}
    {{ Form::date('dateEnd', \Carbon\Carbon::now()) }}

</div>

<!--  Local Field -->
<div class="form-group col-sm-12">
    {!! Form::label('fiwarePath', 'Nombre de spa:') !!}
    {{ Form::select('fiwarePath', $spa, 'null', ['id'=>'spa','class' => 'form-control', 'placeholder'=>'Selecciona un spa']) }}
</div>

<!--  Local Field -->
<div class="form-group col-sm-12">
    {!! Form::label('transmisor', 'Emisor:') !!}
    {{ Form::select('transmisor', ['placeholder'=>'Selecciona un emisor'],null,['id'=>'cerebro','class' => 'form-control']) }}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Consultar', ['class' => 'btn btn-primary']) !!}
</div>


