@extends('layouts.main')

@section('title', 'Sign in to your account')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="card">
                <div class="card-header">
                    Sign in to your account
                </div>

                <div class="card-block">
                    <form method="post">
                        @include('partials/errors')
                        
                        <div class="form-group row">
                            <label for="username" name="username" class="col-sm-2 form-control-label">Username</label>
                            
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}" id="username" placeholder="Username" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" name="password" class="col-sm-2 form-control-label">Password</label>
                            
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10 col-sm-offset-2">
                                <div class="checkbox">
                                    <label><input type="checkbox" name="remember"> Remember me</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-primary">Sign in</button>
                                <a href="#" class="btn btn-success-outline">Password Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop