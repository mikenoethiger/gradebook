@extends('base')

@section('title')
    Notenbuch - Passwort zurücksetzen
@stop

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Passwort zurücksetzen</h3>
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error:</span>
                                {{ $errors->first() }}
                            </div>
                        @endif


                        <form role="form" method="POST" action="{{ url('/password/email') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <div class="input-group margin-bottom-sm">
                                    <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                    <input class="form-control" placeholder="E-Mail" name="email" type="email"
                                           value="{{ old('email') }}" autofocus>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-lg btn-primary btn-block">Reset Link schicken</button>
                            <br>
                            <a href="{{ url('/auth/login') }}">Abbrechen</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop