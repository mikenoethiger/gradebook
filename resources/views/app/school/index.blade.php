<?php
$schoolBreadcrumb = false;
?>
@extends('app')

@section('title')
    Notenbuch - Schule
@stop

@section('header')
    Schule Übersicht
@stop

@section('content')
    <?php
    $headerColumns = ['<i class="fa fa-tags fa-fw"></i> Schule', '<i class="fa fa-inbox fa-fw"></i> Semester',  'Aktionen'];
    $rows = [];
    foreach ($schools as $school) {
        $col1 = $school->name;
        $col2 = sprintf("%s Semester", $school->semesters()->count());
        $col3 = "";
        $row = [$col1, $col2, $col3];
        array_push($rows, $row);
    }
    $entityName = "Schule";
    $entityNamePlural = "Schulen";
    $createEntityUrl = $basePath . "/school/create";
    ?>
    @include('subviews.entitytable')
@stop