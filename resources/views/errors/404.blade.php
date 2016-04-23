
<!-- Bootstrap core CSS -->
<link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('front/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

<!-- Appel style -->
<link href="{{ asset('front/css/notFound.css') }}" rel="stylesheet">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <div class="jumbotron">
                        <h1>Oops!</h1>
                        <strong style="font-size: 0.7em; text-transform: capitalize;">404 Not Found</strong>
                        <div class="error-details">
                            <p style="">Désolé, une erreur est survenue, la page demandée est introuvable !</p>
                            <p style="">Sorry, an error has occured, Requested page not found!</p>
                        </div>
                        <div class="error-actions">
                            <a href="{{route('home')}}" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span></a>
                            <a href="{{URL::previous()}}" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-hand-left"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- jQuery -->
<script src="{{ asset('front/js/jquery.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
