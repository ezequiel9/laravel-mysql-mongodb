@extends('layouts.app')

@section('content')
    {{--Get admin component--}}
    <admin-dashboard :user="{{$user->toJson()}}"></admin-dashboard>
@endsection
