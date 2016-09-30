<html>
	<title>
	edit	
	</title>
	<body>
	<h1>Edit {!! $article->title !!}</h1>	

	{!! Form::model($article , ['method'=>'PATCH', 'action'=>['ArticlesController@update',$article->id]]) !!}

    @include('articles.form',['submitButton'=>'Edit Article'])
 

    {!! Form::close() !!}

@include('errors.list')

	</body>
</html>