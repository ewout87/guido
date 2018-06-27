<div class="form-group-row">
  {!! Form::open(['action' => 'dashboardController@store', 'method' => 'POST']) !!}
  {{Form::text('body', '', ['class' => 'form-control', 'placeholder' => "What's up?"])}}
  {{Form::hidden('author_id', Auth::user()->id, ['class' => 'form-control'])}}
  {{Form::submit('Send', ['class' => 'btn btn-outline-default'])}}
  {!! Form::close() !!}
</div>
        