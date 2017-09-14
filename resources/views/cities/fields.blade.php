@push('scripts')
    <script src="/js/initselect.js"></script>
@endpush

<!-- Nameen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nameEn', 'English Name:') !!}
    {!! Form::text('names[values][en]', null, ['class' => 'form-control']) !!}
</div>

<!-- Nameru Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nameRu', 'Russian Name:') !!}
    {!! Form::text('names[values][ru]', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-6">
    {!! Form::label('countryId', 'Country:') !!}
    {!! Form::select('countryId', $allCountries, null, ['class' => 'form-control select2 select2-hidden-accessible', 'style' => "width: 100%"]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('cities.index') !!}" class="btn btn-default">Cancel</a>
</div>
