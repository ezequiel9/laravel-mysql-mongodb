@extends('layouts.app')

@section('content')
    {{--Get post component from vue--}}
    <post :post="{{$post->toJson()}}" :related_posts="{{$related_posts->toJson()}}" :user="{{Auth::user() ?? null}}"></post>
@endsection
