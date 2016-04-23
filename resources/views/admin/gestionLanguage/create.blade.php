@extends('admin.layout.home')

@section('content')

    <section class="content-header">
        <h1>
            Pages
            <small>Language - Création -</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ ucfirst(route('bo')) }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Pages</li>
        </ol>
    </section>

    <link href="{{ asset('front/css/login.css') }}" rel="stylesheet">

    <div class="space"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-7 col-md-offset-2">

                <div>
                    @include('admin.layout.success')
                    @include('admin.layout.errors_request')
                    @include('admin.layout.error')
                </div>

                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <p>Ajout de fichier de langue - Création -</p>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">


                                <p style="border: 4px groove #005983; background-color: #15a589; color:#fff; padding-left: 10px; padding-right: 10px; padding-top: 10px; padding-bottom: 10px;">Hello, La traduction de fichier marche toujours par 2<br />
                                    on a un fichier en français et un fichier en anglais. après avoir crée ses deux fichier vous devez traduire ce que vous souhaiter. <br />
                                    <span>Alors allez y et amusez vous bien !</span>
                                    <br />
                                    <span>exemple d'utilisation<br/>
                                          php return['key' => 'value', 'key2' => 'value2' ...]; ?></span>
                                </p>


                                {!! Form::open(['method' => 'post', 'url' => route('gestionLanguage.store')]) !!}


                                <div class="form-group">
                                    {!! Form::label('nom', 'nom du fichier *', array('class' => 'col-md-4 col-md-offset-5 control-label')) !!}
                                    {!! Form::text('nom', '', array('class'=>'form-control', 'name'=>'nom', 'placeholder' => 'nom du fichier', 'required'=>'required')) !!}
                                </div>


                                <?php
                                $var = "
                                <?php
                                    return[
                                        'key'   => 'value',
                                        'key'   => 'value',
                                        'key'   => 'value',
                                        etc...
                                    ];";
                                ?>

                                <div class="form-group">
                                    {!! Form::label('francais', 'francais *', array('class' => 'col-md-4 col-md-offset-5 control-label')) !!}
                                    <textarea class="form-control" name="francais" placeholder="francais" required="required" cols="50" rows="10" id="francais"><?= $var; ?></textarea>
                                </div>



                                <div class="form-group">
                                    {!! Form::label('english', 'english *', array('class' => 'col-md-4 col-md-offset-5 control-label')) !!}
                                    <textarea class="form-control" name="english" placeholder="english" required="required" cols="50" rows="10" id="english"><?= $var ?></textarea>
                                </div>



                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <input type="submit" name="submit" id="submit" class="form-control btn btn-register" value="CREATE">
                                        </div>
                                    </div>
                                </div>

                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop








@section('footer')

        <!-- TINY MCE -->
        <script src="{{ asset('plugins/tinymce/jquery.tinymce.min.js') }}"></script>
        <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>

        <script type="text/javascript">
            tinymce.init({
                selector: "textarea",
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                toolbar: "insertfile undo redo | styleselect | code | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            });
        </script>

@stop