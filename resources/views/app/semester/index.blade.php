@extends('app')

@section('title')
    Notenbuch - Semester
@stop

@section('header')
    Semester
@stop

@section('content')
    @include('subviews.semester-breadcrumb', ['semesterBreadcrumb' => false])

    <?php
    $headerColumns = ['<i class="fa fa-graduation-cap fa-fw"></i> Semester', '<i class="fa fa-inbox fa-fw"></i> Fächer', '<i class="fa fa-tags fa-fw"></i> Noten', 'Aktionen'];
    $rows = [];
    foreach ($semesters as $semester) {
        $col1 = 'Semester ' . $semester->semester_number;
        $col2 = $semester->subjects()->count() . " Fächer";
        $col3 = $semester->grades()->count();
        $col4 = "";
        $row = [$col1, $col2, $col3, $col4];
        array_push($rows, $row);
    }
    $entityName = "Note";
    $entityNamePlural = "Noten";
    $createEntityUrl = $basePath . "/grade/create";
    ?>
    @include('subviews.entitytable')
@stop