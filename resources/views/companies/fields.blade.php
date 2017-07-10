<!-- Legalname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('profile[legalName]', 'Legalname:') !!}
    {!! Form::text('profile[legalName]', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('companies.index') !!}" class="btn btn-default">Cancel</a>
</div>
