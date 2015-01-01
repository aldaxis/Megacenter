@extends('admin._layouts.default')
 
@section('main')
    
    <div id="login" class="page pg-login">

        <div class="errors">
            @if ($errors->has('login'))
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ $errors->first('login', ':message') }}
                </div>
            @endif
        </div>

        <div class="form-login">
            {{ Form::open(array('method' => 'post', 'class' => 'form-signin')) }}

                <h2 class="form-signin-heading">Painel administrativo</h2>

                <div class="input-group login">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    {{ Form::text('email', null, array('class' => 'form-control', 'id' => 'txtLogin', 'placeholder' => 'Login ou e-mail')) }}
                </div>

                <div class="input-group password">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    {{ Form::password('password', array('class' => 'form-control', 'id' => 'txtPassword', 'placeholder' => 'Senha')) }}
                </div>

                <div class="form-actions">
                    <label class="checkbox pull-left">
                        <input type="checkbox" name="remember_me" id="ckbRememberMe" value="1">Mantenha-me conectado
                    </label>
                    {{ Form::submit('Login', array('class' => 'btn btn-md btn-primary btn-submit pull-right', 'data-loading-text' => 'Enviando...')) }}
                </div>

            {{ Form::close() }}
        </div>
       
    </div>
@stop