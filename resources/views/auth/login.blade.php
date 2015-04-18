@extends('base')

@section('title')
    Notenbuch - Login
@stop

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center"><h1>Notenbuch</h1></div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Bitte anmelden</h3>
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error:</span>
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <form role="form" method="POST" action="{{ url('/auth/login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="form-group">
                                    <div class="input-group margin-bottom-sm">
                                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                        <input class="form-control" placeholder="E-Mail" name="email" type="email" value="{{ old('email') }}" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group margin-bottom-sm">
                                        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                        <input class="form-control" placeholder="Passwort" name="password"
                                               type="password"
                                               value="">
                                    </div>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Angemeldet bleiben
                                    </label>
                                    <label style="float: right;">
                                        <a href="{{ url('/auth/register') }}">Konto erstellen</a>
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
                                <br>
                                <a href="/password/email">Passwort vergessen?</a>
                                <a href="/" style="float: right;">Startseite</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop