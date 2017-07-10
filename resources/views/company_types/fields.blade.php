<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Nameen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nameEn', 'Nameen:') !!}
    {!! Form::text('names[values][en]', null, ['class' => 'form-control']) !!}
</div>

<!-- Nameru Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nameRu', 'Nameru:') !!}
    {!! Form::text('names[values][ru]', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('companyTypes.index') !!}" class="btn btn-default">Cancel</a>
</div>
