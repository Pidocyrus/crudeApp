@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}


                        <br>
                        <div style="border: 3px solid black; margin:10px; padding:10px;">
                            <h2>Post an Update</h2>
                            <form action="{{ route('createpost') }}" method="POST">
                                @csrf
                                <input type="text" placeholder="post title" name="title" class="form-control"><br>
                                <textarea name="body" placeholder="body content..." rows="10" cols="40"></textarea><br>
                                <button type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                        <div class="card-body">
                           <h2>All Post</h2>
                           @foreach($posts as $post)
                        <div style="border: 3px solid grey; padding:10px; margin:10px;">
                             <h3>{{ $post['title'] }} By <b>{{ $post->user->name }}</b></h3>
                               {{ $post['body'] }}
                                 <p><a href="/edit-post/{{ $post->id }}">Edit</a></p>
                                 <form action="/delete-post/{{ $post->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button>Delete</button>
                                </form>
                        </div>
                        </div>
                         @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection


