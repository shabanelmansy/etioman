<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	 
	<title>create</title>
	 
</head>
<body>

<p> create new acrticle </p>

{!! Form::open(['url'=>'articles']) !!}

@include('articles.form',['submitButton'=>'Add Article'])

{!! Form::close() !!}

@include('errors.list')	
</body>
</html>