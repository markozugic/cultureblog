@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default">Go Back</a>
    <h1>{{$post->title}}</h1>
    @if($post->cover_image !== 'noImage')
        <img style="width: 600px; height: 400px" src="/storage/cover_images/{{$post->cover_image}}">
    @endif
    <br><br>
    <div id="postBody">
        {!!$post->body!!}
    </div>
    <a href="/pdf/{{$post->id}}" class="btn btn-default" target="_blank">Generate pdf</a>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
        @endif
    @endif
@endsection



