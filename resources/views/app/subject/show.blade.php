@extends('app')

@section('title')
    Notenbuch - {{ $subject->name }}
@stop

@section('header')
    {{ $subject->name }}
@stop

@section('content')
    @include('subviews.semester-breadcrumb')
@stop