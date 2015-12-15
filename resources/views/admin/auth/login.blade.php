@extends('admin.layouts.default_login')
@section('content')
    <form class="form-signin" method="POST" action="{{ route('admin.auth.login') }}" accept-charset="UTF-8">
        @include('common.errors')
        <h2 class="form-signin-heading">{{trans('Login')}}</h2>
        <input name="_token" type="hidden" value="{{ csrf_token() }}">
        <label class="sr-only" for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control"/>
        <label class="sr-only" for="password">Password</label>
        <input class="form-control" type="password" name="password" id="password"/>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember-me" value="0"/> Remember me
            </label>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
@stop

@section('styles')
    <style>

        body {
            background-color: #eee;
            padding-bottom: 40px;
            padding-top: 40px;
        }
        .form-signin {
            margin: 0 auto;
            max-width: 330px;
            padding: 15px;
        }
        .form-signin .form-signin-heading, .form-signin .checkbox {
            margin-bottom: 10px;
        }
        .form-signin .checkbox {
            font-weight: normal;
        }
        .form-signin .form-control {
            box-sizing: border-box;
            font-size: 16px;
            height: auto;
            padding: 10px;
            position: relative;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="email"] {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
            margin-bottom: -1px;
        }
        .form-signin input[type="password"] {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            margin-bottom: 10px;
        }

    </style>
@stop