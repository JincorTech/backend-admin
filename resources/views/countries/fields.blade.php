@push('scripts')
<script src="/js/initselect.js"></script>
@endpush

<!-- Nameen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('names[en]', 'English Name:') !!}
    {!! Form::text('names[en]', null, ['class' => 'form-control']) !!}
</div>

<!-- Nameru Field -->
<div class="form-group col-sm-6">
    {!! Form::label('names[ru]', 'Russian Name:') !!}
    {!! Form::text('names[ru]', null, ['class' => 'form-control']) !!}
</div>

<!-- Phonecode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phoneCode', 'Phone Code:') !!}
    {!! Form::text('phoneCode', null, ['class' => 'form-control']) !!}
</div>

<!-- ISO2 Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ISOCodes[ISO2Code]', 'ISO2 Code:') !!}
    {!! Form::text('ISOCodes[ISO2Code]', null, ['class' => 'form-control']) !!}
</div>

<!-- Numericcode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ISOCodes[numericCode]', 'Numeric Code:') !!}
    {!! Form::text('ISOCodes[numericCode]', null, ['class' => 'form-control']) !!}
</div>

<!-- Alpha2Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ISOCodes[alpha2Code]', 'Alpha2 Code:') !!}
    {!! Form::text('ISOCodes[alpha2Code]', null, ['class' => 'form-control']) !!}
</div>

<!-- Alpha3Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ISOCodes[alpha3Code]', 'Alpha3 Code:') !!}
    {!! Form::text('ISOCodes[alpha3Code]', null, ['class' => 'form-control']) !!}
</div>

<!-- Currency Field -->
<div class="form-group col-sm-6">
    {!! Form::label('currency', 'Currency:') !!}
    {!! Form::select('currency', $currencies, null, ['class' => 'form-control select2 select2-hidden-accessible', 'style' => "width: 100%"]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('countries.index') !!}" class="btn btn-default">Cancel</a>
</div>
