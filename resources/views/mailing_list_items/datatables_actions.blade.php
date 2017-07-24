{!! Form::open(['route' => ['mailingListItems.destroy', $_id], 'method' => 'delete']) !!}
<div class='btn-group'>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
