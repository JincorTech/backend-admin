<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Mailinglistid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mailingListId', 'Mailing List:') !!}
    {!! Form::select('mailingListId', [
        'ico@jincor.com' => 'ICO',
        'beta@jincor.com' => 'Beta',
        'test@jincor.com' => 'Test',
    ], null, ['class' => 'form-control', 'style' => "width: 100%"]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('mailingListItems.index') !!}" class="btn btn-default">Cancel</a>
</div>
