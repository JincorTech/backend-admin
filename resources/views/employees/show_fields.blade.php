<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $employee->id !!}</p>
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('company', 'Company:') !!}
    <p>{!! $employee->department->getCompany->profile['legalName'] !!}</p>
</div>
