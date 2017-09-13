<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $city->id !!}</p>
</div>

<!-- Name Ru Field -->
<div class="form-group">
    {!! Form::label('name_ru', 'Russian Name:') !!}
    <p>{!! $city->names['values']['ru'] !!}</p>
</div>

<!-- Name En Field -->
<div class="form-group">
    {!! Form::label('name_en', 'English Name:') !!}
    <p>{!! $city->names['values']['en'] !!}</p>
</div>

<!-- Country Field -->
<div class="form-group">
    {!! Form::label('country', 'Country:') !!}
    <p>{!! $city->country->names['en'] !!}</p>
</div>
