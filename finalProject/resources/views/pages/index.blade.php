@extends('layouts.app')

@section('content')

    {!! Form::open(['action'=>'DictionariesController@search','method'=>'GET']) !!}
    <div class="input-group">
        {{Form::text('q',$q,['class'=>'form-control','placeholder'=>'Search'])}}

        {{Form::select('language', ['E' => 'English', 'K' => 'Korean'],$selectOption,['class'=>'btn btn-outline-secondary dropdown-toggle'])}}

        {{Form::button('search',['class'=>'btn btn-dark','type'=>'submit'])}}

    </div>
    {!! Form::close() !!}

@endsection
