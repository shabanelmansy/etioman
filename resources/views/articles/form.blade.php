


{!!  Form::label('title', 'Title'); !!}
{!!  Form::text('title');  !!}

<br><br><br><br>

{!!  Form::label('body', 'Body'); !!}
{!!  Form::textarea('body');  !!}

<br><br><br><br>

{!!  Form::label('published_at', 'Body'); !!}
{!!  Form::input('date','published_at',date('Y-m-d'));  !!}
<br><br><br><br>


{!!  Form::submit($submitButton); !!}