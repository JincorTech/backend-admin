<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $country->id !!}</p>
</div>

<!-- Nameen Field -->
<div class="form-group">
    {!! Form::label('names[en]', 'English Name:') !!}
    <p>{!! $country->names['en'] !!}</p>
</div>

<!-- Nameru Field -->
<div class="form-group">
    {!! Form::label('names[ru]', 'Russian Name:') !!}
    <p>{!! $country->names['ru'] !!}</p>
</div>

<!-- Phonecode Field -->
<div class="form-group">
    {!! Form::label('phoneCode', 'Phone Code:') !!}
    <p>{!! $country->phoneCode !!}</p>
</div>

<!-- Iso2Code Field -->
<div class="form-group">
    {!! Form::label('ISOCodes[ISO2Code]', 'ISO2 Code:') !!}
    <p>{!! $country->ISOCodes['ISO2Code'] !!}</p>
</div>

<!-- Numericcode Field -->
<div class="form-group">
    {!! Form::label('ISOCodes[numericCode]', 'Numeric Code:') !!}
    <p>{!! $country->ISOCodes['numericCode'] !!}</p>
</div>

<!-- Alpha2Code Field -->
<div class="form-group">
    {!! Form::label('ISOCodes[alpha2Code]', 'Alpha2 Code:') !!}
    <p>{!! $country->ISOCodes['alpha2Code'] !!}</p>
</div>

<!-- Alpha3Code Field -->
<div class="form-group">
    {!! Form::label('ISOCodes[alpha3Code]', 'Alpha3 Code:') !!}
    <p>{!! $country->ISOCodes['alpha3Code'] !!}</p>
</div>
