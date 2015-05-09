@extends('base')

@section('head')
    @parent

            <!-- MetisMenu CSS -->
    <link href="/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
@stop


@section('body')
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Navigation umschalten</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url($basePath . '/dashboard') }}">Notenbuch</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-plus fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url($basePath . '/grade/create') }}"><i class="fa fa-tags fa-fw"></i> Note</a>
                        </li>
                        <li><a href="{{ url($basePath . '/subject/create') }}"><i class="fa fa-inbox fa-fw"></i> Schulfach</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->

            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{{ url($basePath . '/dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ url($basePath . '/grade') }}"><i class="fa fa-tags fa-fw"></i> Noten</a>
                        </li>
                        <li>
                            <a href="{{ url($basePath . '/subject') }}"><i class="fa fa-inbox fa-fw"></i> Schulfächer</a>
                        </li>
                        <li>
                            <a href="{{ url($basePath) . '/exam' }}"><i class="fa fa-pencil fa-fw"></i> Prüfungen <span class="label label-default" style="float: right;">coming soon</span></a>
                        </li>
                        <li>
                            <a href="{{ url($basePath) . '/semester' }}"><i class="fa fa-graduation-cap fa-fw"></i> Semester <span class="label label-default" style="float: right;">coming soon</span></a>
                        </li>
                        <li>
                            <a href="{{ url($basePath . '/school') }}"><i class="fa icon-school fa-fw"></i> Schulen <span class="label label-default" style="float: right;">coming soon</span></a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        @yield('header')
                    </h1>
                </div>
            </div>
            @if(isset($schoolBreadcrumb) && $schoolBreadcrumb)
                <div>
                    <ul class="breadcrumb">
                        <li><a href="#">Link1</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Operations <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Operations 1</a></li>
                                <li><a href="#">Operations 2</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Link2</a></li>
                    </ul>
                </div>
            @endif
            @if(Session::has('message'))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert {{ Session::get('alertClass', 'alert-info') }}"
                             role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            {!! Session::get('message') !!}
                        </div>
                    </div>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Error:</span>
                            {{ $errors->first() }}
                        </div>
                    </div>
                </div>
            @endif

            @yield('content')


        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
@stop

@section('scripts')
    @parent
            <!-- Metis Menu Plugin JavaScript -->
    <script src="/bower_components/metisMenu/dist/metisMenu.min.js"></script>
@stop