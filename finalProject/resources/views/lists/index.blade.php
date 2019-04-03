@extends('layouts.app')

@section('content')
    <h1>Lists</h1>

    @if(Auth::check())
        @if(count($lists)>0)
            @foreach($lists as $list)
                <div class="list-group-item">
                    <h3><a href="/lists/{{$list->list}}">{{$list->list}}</a></h3>
                </div>
            @endforeach
        @else
            <p>No lists found</p>
        @endif
    @else
        <div class="list-group-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </div>
    @endif
@endsection

