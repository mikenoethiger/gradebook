<?php
function getPanelColor($gradeAverage)
{
    if ($gradeAverage <= 6 && $gradeAverage > 5) {
        return "panel-green";
    } else if ($gradeAverage <= 5 && $gradeAverage > 4) {
        return "panel-primary";
    } else if ($gradeAverage <= 4 && $gradeAverage > 3) {
        return "panel-yellow";
    } else if ($gradeAverage <= 3 && $gradeAverage >= 1) {
        return "panel-red";
    } else if ($gradeAverage < 1) {
        return "panel-primary";
    }
}

?>

@extends('app')

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
    @endif
    <div class="row">
        @foreach($subjects as $subject)
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="panel {{ getPanelColor($subject->average()) }}">
                    <div class="panel-heading">

                        <div class="row">
                            <div class="col-xs-3">
                                <span class="{{ $subject->icon }} fa-5x"></span>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $subject->average() < 0 ? "-" : $subject->average() }}</div>
                                <div>{{ $subject->name }}</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
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
@stop