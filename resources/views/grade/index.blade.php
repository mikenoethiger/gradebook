@extends('app')



@section('title')
    Notenbuch - Noten
@stop

@section('header')
    Noten
@stop

@section('content')
        @include('subviews.gradelist')
@stop
