@extends('layouts.main')

@section('title', 'Create an account')

@section('content')
    <quill-register inline-template>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="card">
                    <div class="card-header">
                        Create an account
                    </div>

                    <div class="card-block">
                        <form @submit="handleRegisterFormSubmission" method="post">
                            @include('partials.errors')

                            <div class="form-group row" :class="{'has-danger': form.hasError('username')}">
                                <label for="username" class="col-sm-2 form-control-label">Username</label>
                                
                                <div class="col-sm-10">
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" v-model="form.username" autofocus>
                                    <small v-if="form.hasError('username')" class="text-danger">@{{ form.errors.username }}</small>
                                </div>
                            </div>

                            <div class="form-group row" :class="{'has-danger': form.hasError('email')}">
                                <label for="email" class="col-sm-2 form-control-label">Email</label>
                                
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" v-model="form.email">
                                    <small v-if="form.hasError('email')" class="text-danger">@{{ form.errors.email }}</small>
                                </div>
                            </div>

                            <div class="form-group row" :class="{'has-danger': form.hasError('password')}">
                                <label for="password" class="col-sm-2 form-control-label">Password</label>
                                
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" v-model="form.password">
                                    <small v-if="form.hasError('password')" class="text-danger">@{{ form.errors.password }}</small>
                                </div>
                            </div>

                            <div class="form-group row" :class="{'has-danger': form.hasError('password_conf')}">
                                <label for="password_conf" class="col-sm-2 form-control-label">Confirm</label>
                                
                                <div class="col-sm-10">
                                    <input type="password" name="password_conf" class="form-control" id="password_conf" placeholder="Confirm Password" v-model="form.password_conf">
                                    <small v-if="form.hasError('password_conf')" class="text-danger">@{{ form.errors.password_conf }}</small>
                                </div>
                            </div>

                            <div class="form-group row" :class="{'has-danger': form.hasError('agree')}">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <div class="checkbox">
                                        <label><input name="agree" v-model="form.agree" type="checkbox"> I have read and agree to the <a tabindex="-1" href="#">terms and conditions</a>.</label>
                                        <small v-if="form.hasError('agree')" class="text-danger"><br> @{{ form.errors.agree }}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    
                                    <button :disabled="form.processing" type="submit" class="btn btn-primary">
                                        <i v-if="form.processing" class="fa fa-cog fa-spin"></i>
                                        <i v-else class="fa fa-user"></i>

                                        Create account
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </quill-register>
@stop