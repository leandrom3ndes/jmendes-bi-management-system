@extends('layouts.login')

@section('content')
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Introduza as suas credenciais</h3>
            </div>
            <div class="panel-body">
                <form role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <fieldset>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input class="form-control" placeholder="Password" name="password" type="password" value="">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Lembrar
                            </label>
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <button type="submit" class="btn btn-lg btn-success btn-block">
                            Login
                        </button>
                        <a class="btn btn-link" href="{{ url('/password/reset') }}">
                            Esqueceu-se da password?
                        </a>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
