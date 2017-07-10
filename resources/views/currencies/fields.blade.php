<!-- Nameen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nameEn', 'English Name:') !!}
    {!! Form::text('names[en]', null, ['class' => 'form-control']) !!}
</div>

<!-- Nameru Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nameRu', 'Russian Name:') !!}
    {!! Form::text('names[ru]', null, ['class' => 'form-control']) !!}
</div>

<!-- Alpha3Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alpha3Code', 'Alpha3 Code:') !!}
    {!! Form::text('ISOCodes[alpha3Code]', null, ['class' => 'form-control']) !!}
</div>

<!-- Numericcode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numericCode', 'Numeric Code:') !!}
    {!! Form::text('ISOCodes[numericCode]', null, ['class' => 'form-control']) !!}
</div>

<!-- Sign Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sign', 'Sign:') !!}
    {!! Form::text('sign', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('currencies.index') !!}" class="btn btn-default">Cancel</a>
</div>
