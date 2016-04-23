@extends('admin.layout.home')

@section('content')
    <section class="content-header">
        <h1>
            Pages
            <small>Actualités - Edition</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ ucfirst(route('bo')) }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Pages</li>
        </ol>
    </section>

    <link href="{{ asset('admin/css/form.css') }}" rel="stylesheet">

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
                            <p>Edition d'une Actualités</p>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                {!! Form::open(['method' => 'put', 'url' => route('actu.update', $actu->id)]) !!}


                                <div class="form-group">
                                    {!! Form::hidden('id_users', Auth::user()->id, array('class'=>'form-control', 'name'=>'id_users', 'placeholder' => 'id_users', 'required'=>'required')) !!}
                                </div>

                                <!-- List Select via BDD (function List(-laravel-)) -->
                                <div class="form-group">
                                    {!! Form::label('id_langues', 'langue *', array('class' => 'col-md-4 col-md-offset-5 control-label')) !!}
                                    {!! Form::select('id_langues', $langue, $actu->id_langues, ['class'=>'form-control']) !!}
                                </div>
                                <!-- Fin function List -->


                                <div class="form-group">
                                    {!! Form::label('titre', 'Titre *', array('class' => 'col-md-4 col-md-offset-5 control-label')) !!}
                                    {!! Form::text('titre', $actu->titre, array('class'=>'form-control', 'name'=>'titre', 'placeholder' => 'Titre', 'required'=>'required')) !!}
                                </div>


                                <div class="form-group">
                                    {!! Form::label('description', 'Description *', array('class' => 'col-md-4 col-md-offset-5 control-label')) !!}
                                    {!! Form::textarea('description', $actu->description, array('class'=>'form-control', 'name'=>'description', 'placeholder' => 'Description', 'required'=>'required')) !!}
                                </div>



                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <input type="submit" name="submit" id="submit" class="form-control btn btn-register" value="EDITION">
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
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>


@stop