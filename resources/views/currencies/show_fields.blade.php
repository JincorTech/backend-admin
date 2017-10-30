<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $currency->id->getData() !!}</p>
</div>

<!-- Nameen Field -->
<div class="form-group">
    {!! Form::label('nameEn', 'English Name:') !!}
    <p>{!! $currency->names['en'] !!}</p>
</div>

<!-- Nameru Field -->
<div class="form-group">
    {!! Form::label('nameRu', 'Russian Name:') !!}
    <p>{!! $currency->names['ru'] !!}</p>
</div>

<!-- Alpha3Code Field -->
<div class="form-group">
    {!! Form::label('alpha3Code', 'Alpha3 Code:') !!}
    <p>{!! $currency->ISOCodes['alpha3Code'] !!}</p>
</div>

<!-- Numericcode Field -->
<div class="form-group">
    {!! Form::label('numericCode', 'Numeric code:') !!}
    <p>{!! $currency->ISOCodes['numericCode'] !!}</p>
</div>

<!-- Sign Field -->
<div class="form-group">
    {!! Form::label('sign', 'Sign:') !!}
    <p>{!! $currency->sign !!}</p>
</div>
