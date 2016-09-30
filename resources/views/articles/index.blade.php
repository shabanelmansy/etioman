<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	 
</head>
<body>

@foreach($articles as $article)
 <h1> <a href="/articles/{{ $article->id }}">{{ $article->title }} </a></h1>
 <p>
 	
 	 {{ $article->body }}

 </p>
@endforeach


</body>
</html>