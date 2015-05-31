@extends('base')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">Reset Password</h3></div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form role="form" method="POST" action="{{ url('/password/reset') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <div class="input-group margin-bottom-sm">
                                    <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                    <input class="form-control" placeholder="E-Mail" name="email" type="email" value="{{ old('email') }}" autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group margin-bottom-sm">
                                    <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                    <input class="form-control" placeholder="Neues Passwort" name="password"
                                           type="password"
                                           value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group margin-bottom-sm">
                                    <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                    <input class="form-control" placeholder="Passwort wiederholen" name="password_confirmation"
                                           type="password"
                                           value="">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-lg btn-primary btn-block">Passwort zurücksetzen</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
