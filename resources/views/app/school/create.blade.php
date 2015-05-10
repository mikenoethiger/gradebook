<?php
$schoolBreadcrumb = false;
?>
@extends('app')

@section('title')
    Notenbuch - Schule erfassen
@stop

@section('header')
    Schule erstellen
@stop

@section('content')
    <form action="{{ url('/school') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa icon-school"></i></span>
                        <input name="name" class="form-control" placeholder="Name">
                        <span class="input-group-btn">
                                <button type="submit" class="btn btn-default" type="button">Erfassen</button>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                        <textarea name="description" class="form-control"
                                  placeholder="Beschreibung (optional)"></textarea>
                </div>
                <input name="icon" type="hidden">
            </div>
        </div>
    </form>
@stop