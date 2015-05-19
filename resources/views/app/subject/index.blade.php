@extends('app')

@section('head')
    <!-- DataTables CSS -->
    <link href="/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom Datatable Theme -->
    <link href="/css/datatable.css" rel="stylesheet">
@stop

@section('title')
    Notenbuch - Fächer
@stop

@section('header')
    Fächer
@stop

@section('content')
    @include('subviews.semester-breadcrumb')

    <?php
    $headerColumns = ['<i class="fa fa-inbox fa-fw"></i> Fach', '<i class="fa fa-tags fa-fw"></i> Anzahl', '<span class="hidden-xs">Ø Durchschnitt</span><span class="visible-xs">Ø Durchschn.</span>', 'Aktionen'];
    $rows = [];
    foreach ($subjects as $subject) {
        $col1 = "<span class='{{ $subject->icon }} fa-2x'></span> " . $subject->name;
        $col2 = count($subject->grades) . " Noten";
        $col3 = $subject->average() < 0 ? '-' : $subject->average();
        $col4 = sprintf("<form id='delete-subject-%s' method='post' action='/subject/%s'>
                            <input type='hidden' name='_token' value='%s'>
                            <input type='hidden' name='_method' value='delete'>
                        </form>
                        <div class='btn-group' role='group'>
                            <a href='#' class='btn btn-danger' onclick='$(\"#delete-subject-%s\").submit();return false;'>
                                <i class='fa fa-trash-o fa-lg'></i> <span class='hidden-xs'>Löschen</span>
                            </a>
                        </div>", $subject->id, $subject->id, csrf_token(), $subject->id);
        $row = [$col1, $col2, $col3, $col4];
        array_push($rows, $row);
    }
    $entityName = "Fach";
    $entityNamePlural = "Fächer";
    $createEntityUrl = $basePath . "/subject/create";
    ?>
    @include('subviews.entitytable')
@stop