@extends('layouts.app')

@section('content')
    <h1>Clients</h1>
    <a href="/clients/create" class="btn btn-primary">Add client</a>
    @if(count($clients) > 0 )
        @foreach($clients as $client)
            <div class="well">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$client->id}}">{{$client->name}}</a></h3>
                        <small>Joined on {{$client->created_at}}</small>
                    </div>
                </div>        
            </div>
        @endforeach
        {{$clients->links()}}
    @else
        <div>No clients found</div>
    @endif
@endsection