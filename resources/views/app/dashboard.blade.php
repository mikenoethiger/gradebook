<?php
use \Illuminate\Support\Facades\App;
use \App\Services\GradeJudge;
use \App\Exceptions\NoGradesException;

function getClassForAverage($subject) {
    $gradeJudge = App::make('App\Services\GradeJudge');

    $classifications = [];
    $classifications[GradeJudge::VERY_BAD] = "panel-red";
    $classifications[GradeJudge::BAD] = "panel-yellow";
    $classifications[GradeJudge::GOOD] = "panel-primary";
    $classifications[GradeJudge::VERY_GOOD] = "panel-green";
    try {
        //return $classifications[$gradeJudge->classify($subject->average())];
    } catch (NoGradesException $exception) {
        return "panel-primary";
    }
}

$subjectFormatter = App::make('SubjectFormatter');
?>

@extends('app')

@section('head')
    @parent

    <link href="/css/dashboard.css" rel="stylesheet">
@stop

@section('title')
    Notenbuch - Dashboard
@stop

@section('header')
    Dashboard
@stop

@section('content')
    @include('subviews.semester-breadcrumb')
    <!-- /.row -->
    @if(count($subjects) == 0)
        <div class="row">
            <div class="col-sm-12">
                <div class="well well-lg">Du hast noch keine Schulfächer erstellt. <a href="/subject/create">Jetzt
                        beginnen!</a></div>
            </div>
        </div>
    @else
    <div class="row">
        @foreach($subjects as $subject)
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="panel {{  $subjectFormatter->cssClassForAverage($subject) }}">
                    <div class="panel-heading"
                         onclick="window.location.href='/subject/{{ $subject->id }}'">

                        <div class="row">
                            <div class="col-xs-3">
                                <span class="{{ $subject->icon }} fa-5x"></span>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $subjectFormatter->average($subject) }}</div>
                                <div>{{ $subject->name }}</div>
                            </div>
                        </div>
                    </div>
                    <a href="/subject/{{ $subject->id }}">
                        <div class="panel-footer">
                            <span class="pull-left">{{ count($subject->grades) }} Noten</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    @endif
@stop