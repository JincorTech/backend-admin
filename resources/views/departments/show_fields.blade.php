<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $department->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $department->name !!}</p>
</div>

<!-- Company Field -->
<div class="form-group">
    {!! Form::label('company', 'Company:') !!}
    <p>{!! $department->getCompany->profile['legalName'] !!}</p>
</div>
