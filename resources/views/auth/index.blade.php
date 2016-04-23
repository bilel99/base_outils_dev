<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{\Config::get('constante.nom_code')}}</title>


    <!-- Bootstrap -->
    <link href="{{ asset('front/bootstrap-3.3.6-dist/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('front/bootstrap-3.3.6-dist/css/bootstrap-theme.min.css') }}" rel="stylesheet" />

    <!-- CSS -->
    <link href="{{ asset('front/css/login.css') }}" rel="stylesheet" />


    <!-- Bootstrap -->
    <script src="{{ asset('front/bootstrap-3.3.6-dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/bootstrap-3.3.6-dist/js/npm.js') }}"></script>

    <!-- JS -->
    <script src="{{ asset('front/js/login.js') }}"></script>

</head>
<body>

<div id="wrapper">

    <!-- Message erreur, success -->
    <div class="message">
        @include('front.layout.error')
        @include('front.layout.success')
        @include('front.layout.errors_request')
    </div>
    <!-- Fin -->

    {!! Form::open(array('url' => 'authentification', 'role'=>'form', 'method'=>'POST', 'class' => 'login-form')) !!}

    <div class="header">
        <div class="alert alert-info">
            <a href="{{route('register')}}" class="btn btn-xs btn-info pull-right">{{Lang::get('auth.inscriptionRapide')}}</a>
            <span>{{Lang::get('auth.pasinscris')}}</span>
        </div>

        <h1>{{Lang::get('auth.login')}}</h1>
    </div>

    <div class="content">
        {!! Form::email('email', old('email'), array('class'=>'input username', 'name'=>'email', 'placeholder' => Lang::get('global.email'), 'required'=>'required')) !!}
        <div class="user-icon"></div>
        {!! Form::password('password', array('class'=>'input password', 'name'=>'password', 'placeholder' => Lang::get('global.password'), 'required'=>'required')) !!}
        <div class="pass-icon"></div>
    </div>

    <div class="footer">
        <button type="submit" class="button">{{ Lang::get('global.connexion')}}</button>
    </div>
        <span>
            <center>{!! Form::checkbox('remember',1,true) !!} {{ Lang::get('global.rememberMe')}}</center>
            <center><a href="password/email">{{ Lang::get('global.motDePasseOublie')}}</a></center>
        </span>
    {!! Form::close() !!}

</div>
<div class="gradient"></div>

</body>
</html>

