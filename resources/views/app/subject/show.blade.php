<?php
$average = $subject->average() < 0 ? '-' : $subject->average();
$bestGrade = $subject->grades()->orderBy('grade', 'DESC')->first();
$worstGrade = $subject->grades()->orderBy('grade')->first();
$best = $bestGrade == null ? '-' : $bestGrade->grade;
$worst = $worstGrade == null ? '-' : $worstGrade->grade;
?>

@extends('app')

@section('title')
    Notenbuch - {{ $subject->name }}
@stop

@section('header')
    <span class='{{ $subject->icon }} fa-1x'></span> {{ $subject->name }}
@stop

@section('content')
    @include('subviews.semester-breadcrumb', ['readonly' => true])

    <div class="row">
        <div class="col-sm-12">
            <span class="label label-primary tag">Durchschnitt: {{ $average }}</span>

            <div style="float: right;">
                <span class="label label-default tag">{{ $subject->grades()->count() }} Noten</span>
                <span class="label label-default tag">Beste: {{ $best }}</span>
                <span class="label label-default tag">Schlechteste: {{ $worst }}</span>
            </div>
        </div>
    </div>
    <br>

    <?php
    $headerColumns = ['<i class="fa fa-tags fa-fw"></i> Note', 'Gewichtung', '<i class="fa fa-calendar fa-fw"></i> Erfasst am', 'Aktionen'];
    $rows = [];
    foreach ($subject->grades as $grade) {
        $col1 = $grade->grade;
        $col2 = sprintf("x%s", $grade->weighting);
        $col3 = date_format($grade->created_at, 'd.m.Y');
        $col4 = sprintf("<form id='delete-grade-%s' method='post' action='%s/grade/%s'>
                            <input type='hidden' name='_token' value='%s'>
                            <input type='hidden' name='_method' value='delete'>
                        </form>
                        <div class='btn-group' role='group'>
                            <a href='#' class='btn btn-danger' onclick='$(\"#delete-grade-%s\").submit();return false;'>
                                <i class='fa fa-trash-o fa-lg'></i> <span class='hidden-xs'>Löschen</span>
                            </a>
                        </div>", $grade->id, $basePath, $grade->id, csrf_token(), $grade->id);
        $row = [$col1, $col2, $col3, $col4];
        array_push($rows, $row);
    }
    $entityName = "Note";
    $entityNamePlural = "Noten";
    $createEntityUrl = $basePath . "/grade/create?subject=" . $subject->id;
    ?>
    @include('subviews.entitytable')
@stop