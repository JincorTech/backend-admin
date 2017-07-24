<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $mailingListItem->id !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $mailingListItem->email !!}</p>
</div>

<!-- Mailinglistid Field -->
<div class="form-group">
    {!! Form::label('mailingListId', 'Mailing List:') !!}
    <p>{!! $mailingListItem->mailingListId !!}</p>
</div>
