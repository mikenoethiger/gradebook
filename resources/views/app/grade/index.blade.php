@extends('app')

@section('title')
    Notenbuch - Noten
@stop

@section('header')
    Noten
@stop

@section('content')
    @include('subviews.semester-breadcrumb')

    <?php
    $headerColumns = ['<i class="fa fa-tags fa-fw"></i> Note', '<i class="fa fa-inbox fa-fw"></i> Fach',  'Aktionen'];
    $rows = [];
    foreach ($grades as $grade) {
        $col1 = $grade->grade;
        $col2 = sprintf("<span class='%s fa-2x'></span> %s", $grade->subject->icon, $grade->subject->name);
        $col3 = sprintf("<form id='delete-grade-%s' method='post' action='%s/grade/%s'>
                            <input type='hidden' name='_token' value='%s'>
                            <input type='hidden' name='_method' value='delete'>
                        </form>
                        <div class='btn-group' role='group'>
                            <a href='#' class='btn btn-danger' onclick='$(\"#delete-grade-%s\").submit();return false;'>
                                <i class='fa fa-trash-o fa-lg'></i> <span class='hidden-xs'>Löschen</span>
                            </a>
                        </div>", $grade->id, $basePath, $grade->id, csrf_token(), $grade->id);
        $row = [$col1, $col2, $col3];
        array_push($rows, $row);
    }
    $entityName = "Note";
    $entityNamePlural = "Noten";
    $createEntityUrl = $basePath . "/grade/create";
    ?>
    @include('subviews.entitytable')
@stop
