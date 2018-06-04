@extends('layouts.app')

@section('content')
    <h1>Add client</h1>
    {!! Form::open(['action' => 'ClientsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('age', 'Age')}}
            {{Form::text('age', '', ['class' => 'form-control', 'placeholder' => 'Age'])}}
        </div>
        <div class="form-group">
            {{Form::label('height', 'Height')}}
            {{Form::text('height', '', ['class' => 'form-control', 'placeholder' => 'Height'])}}
        </div>
        <div class="form-group">
            {{Form::label('weight', 'Weight')}}
            {{Form::text('weight', '', ['class' => 'form-control', 'placeholder' => 'Weight'])}}
        </div>
        <div class="form-group">
            {{Form::label('activity', 'Activity')}}
            {{Form::text('activity', '', ['class' => 'form-control', 'placeholder' => 'Activity'])}}
        </div>
        <div class="form-group">
            {{Form::label('male', 'Male')}}
            {{ Form::radio('gender', 'male') }}<br>
            {{Form::label('female', 'Female')}}
            {{ Form::radio('gender', 'female') }}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection