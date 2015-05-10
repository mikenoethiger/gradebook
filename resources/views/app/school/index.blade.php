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
        $col3 = sprintf("<form id='delete-grade-%s' method='post' action='%s/grade/%s'>
                            <input type='hidden' name='_token' value='%s'>
                            <input type='hidden' name='_method' value='delete'>
                        </form>
                        <div class='btn-group' role='group'>
                            <a href='#' class='btn btn-danger' onclick='$(\"#delete-grade-%s\").submit();return false;'>
                                <i class='fa fa-trash-o fa-lg'></i> <span class='hidden-xs'>Löschen</span>
                            </a>
                        </div>", $school->id, $basePath, $school->id, csrf_token(), $school->id);
        $row = [$col1, $col2, $col3];
        array_push($rows, $row);
    }
    $entityName = "Schule";
    $entityNamePlural = "Schulen";
    $createEntityUrl = $basePath . "/school/create";
    ?>
    @include('subviews.entitytable')
@stop