@extends('layouts/admin_login')
@section('content')

    <div class="row center-box" id="panel-login">
        <div class="col-lg-4 col-lg-offset-4">
            <form method="POST" action="login" accept-charset="UTF-8">

                <input name="_token" type="hidden" value="{{ csrf_token() }}">

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h4 class="text-center text-uppercase">Login</h4>
                    </div>

                    <div class="panel-body">
                        @include('common.errors')


                        <div class="form-group {{ $errors->has('email') ? 'has-error has-feedback' : null }}">
                            <label class="control-label" for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control"/>
                            @if ($errors->has('email'))
                                @foreach($errors->get('email') as $message)
                                    <p class="help-block">{{ $message }}</p>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error has-feedback' : null }}">
                            <label class="control-label" for="password">Password</label>
                            <input class="form-control" type="password" name="password" id="password"/>
                            @if ($errors->has('password'))
                                @foreach($errors->get('password') as $message)
                                    <p class="help-block">{{ $message }}</p>
                                @endforeach
                            @endif
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember-me" value="0"/> Remember me
                            </label>
                        </div>

                    </div>

                    <div class="panel-footer text-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>

                </div>

            </form>
        </div>
    </div>

@stop
