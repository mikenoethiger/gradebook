@extends('base')

@section('title')
    Notenbuch - Registrieren
@stop

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center"><h1>Notenbuch</h1></div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Neues Konto erstellen</h3>
                    </div>

                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error:</span>
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <form role="form" method="POST" action="{{ url('/auth/register') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="form-group">
                                    <div class="input-group margin-bottom-sm">
                                        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                        <input class="form-control" placeholder="Name" name="name" value="{{old('name')}}" autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group margin-bottom-sm">
                                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                        <input class="form-control" placeholder="E-Mail" name="email" type="email" value="{{ old('email') }}">
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
                                <div class="form-group">
                                    <div class="input-group margin-bottom-sm">
                                        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                        <input class="form-control" placeholder="Passwort wiederholen"
                                               name="password_confirmation"
                                               type="password" value="">
                                    </div>

                                </div>
                                <p style="float:right;">
                                    <a href="{{ url('/auth/login')  }}" >Du hast bereits ein Konto?</a>
                                </p>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Registrieren</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop