<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<h2>Edit Post</h2>
<form action="{{ url('update/' . $post->id) }}" method="POST">
@csrf
<input type="text" name="title" value="{{ $post->title }}">
<textarea name="body" >{{ $post->body }}</textarea>
<button>Save Changes</button>
</form>
</div>

</body>
</html>
