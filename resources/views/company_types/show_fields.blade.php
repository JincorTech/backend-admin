<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $companyType->id->getData() !!}</p>
</div>

<!-- Code Field -->
<div class="form-group">
    {!! Form::label('code', 'Code:') !!}
    <p>{!! $companyType->code !!}</p>
</div>

<!-- Nameen Field -->
<div class="form-group">
    {!! Form::label('nameEn', 'English Name:') !!}
    <p>{!! $companyType->names['values']['en'] !!}</p>
</div>

<!-- Nameru Field -->
<div class="form-group">
    {!! Form::label('nameRu', 'Russian Name:') !!}
    <p>{!! $companyType->names['values']['ru'] !!}</p>
</div>

