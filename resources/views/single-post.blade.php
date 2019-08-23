@extends('layouts.app')

@section('content')
    {{--Get post component from vue--}}
    <post :post="{{$post->toJson()}}" :related_posts="{{$related_posts->toJson()}}" @if(Auth::user()) :user="{{Auth::user()->toJson()}}" @endif></post>
@endsection
