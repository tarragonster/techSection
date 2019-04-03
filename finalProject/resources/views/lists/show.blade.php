@extends('layouts.app')

@section('content')
    <h1>Lists</h1>

            @foreach($lists as $list)
                <p>{{$list->word}}</p>
            @endforeach

@endsection
