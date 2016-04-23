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

        <link href="{{ asset('front/css/auth.css') }}" rel="stylesheet">

    </head>
<body>

<div class="container">

    <!-- Message erreur, success -->
    <div class="message">
        @include('front.layout.error')
        @include('front.layout.success')
        @include('front.layout.errors_request')
    </div>
    <!-- Fin -->



    <div style="margin-top: 10px; opacity: .8;" class="col-md-6 ">
        <div style="height: 360px;" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{Lang::get('auth.title2')}}</h3>
            </div>

            <div class="panel-body">
                test
                <div id="titre_actu">
                    test
                </div>
            </div>

        </div>
    </div>





    <div style="margin-top: 10px; opacity: .8;" class="col-md-4 col-lg-offset-2 ">
        <div style="height: 360px;" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{Lang::get('auth.title1')}}</h3>
            </div>

            <div class="panel-body">
                {!! Form::open(['method' => 'post', 'url' => route('postRegister')]) !!}
                <fieldset>
                    <div class="form-group">
                        {!! Form::text('nom', '', array('class'=>'form-control', 'name'=>'nom', 'placeholder' => Lang::get('auth.nom'), 'required'=>'required')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('prenom', '', array('class'=>'form-control', 'name'=>'prenom', 'placeholder' => Lang::get('auth.prenom'), 'required'=>'required')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::email('email', '', array('class'=>'form-control', 'name'=>'email', 'placeholder' => Lang::get('auth.email'), 'required'=>'required')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::password('password', array('class'=>'form-control', 'name'=>'password', 'placeholder' => Lang::get('auth.password'), 'required'=>'required')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::password('conf_password', array('class'=>'form-control', 'name'=>'conf_password', 'placeholder' => Lang::get('auth.password'), 'required'=>'required')) !!}
                    </div>
                    {!! Form::hidden('id_roles_users', '1', array('class'=>'form-control', 'name'=>'id_roles_users', 'placeholder' => 'id_roles_users', 'required'=>'required')) !!}

                    <input type="submit" name="submit" id="submit" class="btn btn-lg btn-success btn-block" value="{{Lang::get('auth.submit')}}">

                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="{{ asset('lib/jquery.js') }}"></script>

</body>
</html>