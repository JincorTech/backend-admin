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

<!-- Internalcode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('internalCode', 'Internal Code:') !!}
    {!! Form::text('internalCode', null, ['class' => 'form-control']) !!}
</div>

<!-- Parent Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent', 'Parent Type:') !!}
    {!! Form::select('parent', $allTypes, null, ['class' => 'form-control select2 select2-hidden-accessible', 'style' => "width: 100%"]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('economicalActivityTypes.index') !!}" class="btn btn-default">Cancel</a>
</div>
