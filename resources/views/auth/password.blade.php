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

		<script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>

	</head>
<body>

<div class="container">

    @if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
	@endif

    <div style="margin-top: 10px; opacity: .8;" class="col-md-6 col-md-offset-3 ">
        <div style="height: 360px;" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{Lang::get('global.ReInitialisationMdp')}}</h3>
            </div>

            <div class="panel-body">
            	<div class="col-md-10 col-md-offset-1" style="margin-bottom: 20px">
            		Veuillez saisir votre mail.
            	</div>

            	<!-- Message erreur, success -->
			    <div class="col-md-10 col-md-offset-1 message">
					@include('front.layout.error')
					@include('front.layout.success')
					@include('front.layout.errors_request')
			    </div>
			    <!-- Fin -->
			    
            	<div>
	                {!! Form::open(['route'=>['password/email'], 'method' => 'post']) !!}
					    {!! csrf_field() !!}
					    <div class="col-md-10 col-md-offset-1" style="margin-bottom: 10px">
					        {!! Form::email('email', '', array('class'=>'form-control', 'name'=>'email', 'placeholder' => Lang::get('auth.email'), 'required'=>'required')) !!}
					    </div>

					    <div class="col-md-4 col-md-offset-4">
					        <input type="submit" name="submit" id="submit" class="btn btn-md btn-success btn-block" value="{{Lang::get('global.valider')}}">
					    </div>
					{!! Form::close() !!}
				</div>
            </div>
        </div>
    </div>	
</div>

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="{{ asset('lib/jquery.js') }}"></script>
<script src="{{ asset('front/js/changeImageFade.js') }}"></script>

</body>
</html>