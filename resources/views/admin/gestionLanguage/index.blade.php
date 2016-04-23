@extends('admin.layout.home')
@section('content')
    <link href="{{ asset('admin/css/tableGLanguage.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('admin/js/scriptTableGLanguage.js') }}"></script>


    <style>
        .ds-btn li{ list-style:none; float:left; padding:10px; }
        .ds-btn li a span{padding-left:15px;padding-right:5px;width:100%;display:inline-block; text-align:left;}
        .ds-btn li a span small{width:100%; display:inline-block; text-align:left;}
    </style>


    <section class="content-header">
        <h1>
            Gestion de la langue
            <small>Liste</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ ucfirst(route('bo')) }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Gestion Langue</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div>
                    @include('admin.layout.success')
                    @include('admin.layout.errors_request')
                    @include('admin.layout.error')
                </div>

                <div class="box-header"></div><!-- /.box-header -->

                <!-- A l'appuie du bouton générer un formulaire -->
                <ul class="ds-btn">
                    <li>
                        <a class="btn btn-lg btn-primary col-lg-12 " style="margin-left: 70%;" href="{{ route('gestionLanguage.create') }}">
                            <i class="fa fa-language pull-left"></i><span>Crée un fichier de traduction<br><small>Création d'un nouveau fichier de traduction</small></span></a>
                    </li>
                </ul>








                <!-- tableau liste des fichier de traduction anglais - français  avec bouton delete, view and edit -->
                <hr />
                <div style="margin-top: 145px;" class="enter"></div>
                <div class="row">
                    <div class="panel panel-default filterable col-sm-10" style="margin-left: 8%;">
                        <div class="panel-heading">
                            <h3 class="panel-title">Fichier de langues</h3>
                            <div class="pull-right">
                                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr class="filters">
                                <th><input type="text" class="form-control" placeholder="Rechercher" disabled></th>
                                <th></th>
                            </tr>
                            </thead>

                            <tfoot>

                                <tr>
                                    <th>Il y'a actuellement {{count($fichier)-1}} fichier<?= count($fichier)-1 <2?'':'s' ?> de langues</th>
                                    <th></th>
                                </tr>

                            </tfoot>

                            <tbody>
                            @foreach($fichier as $row=>$f)
                                @if($f != '.DS_Store')
                                    <tr>
                                        <td>{{$f}}</td>
                                        <td>
                                            <a type="submit" class="fa fa-eye fa-2x " data-toggle="modal" data-target="#{{ $row }}"></a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


                @foreach($fichier as $row => $f)

                    <!-- Modal View -->
                    <div class="modal fade" id="{{ $row }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                {!! Form::open(['method' => 'put', 'url' => route('gestionLanguage.majfiles', $row) ]) !!}

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Fichier de traduction : {{ $f }}</h4>
                                </div>
                                <div class="modal-body">
                                    <h2>Français</h2>
                                    <p>
                                        <?php
                                        if($f != '.DS_Store'){
                                            $lines = file('../resources/lang/fr/'.$f);
                                            // display file line by line
                                        ?>
                                        <textarea class="form-control" name="francais" placeholder="francais" required="required" cols="50" rows="10" id="francais">
                                            <?php
                                                foreach($lines as $line_num => $line) { ?>
                                                    <?= $line ?> <br />
                                            <?php } ?>
                                        </textarea>
                                        <?php }
                                        ?>
                                    </p>
                                    <hr>
                                    <h2>Anglais</h2>
                                    <p>
                                        <?php
                                        if($f != '.DS_Store'){
                                            $lines = file('../resources/lang/en/'.$f);
                                            // display file line by line
                                        ?>
                                            <textarea class="form-control" name="english" placeholder="english" required="required" cols="50" rows="10" id="english">
                                                <?php
                                                    foreach($lines as $line_num => $line) { ?>
                                                        <?= $line ?> <br />
                                                <?php } ?>
                                            </textarea>
                                        <?php }
                                        ?>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <?php echo Form::submit('Modifier', ['class' => 'btn btn-primary', 'name' => 'send']); ?>

                                {!! Form::close() !!}


                                    {!! Form::open(['method' => 'delete', 'url' => route('gestionLanguage.destroy', $row) ]) !!}
                                        <?php echo Form::submit('delete', ['class' => 'btn btn-danger glyphicon glyphicon-trash', 'name' => 'send']); ?>
                                    {!! Form::close() !!}

                                </div>
                            </div>
                        </div>
                    </div><!-- Fin Modal -->

                @endforeach


            </div><!-- /.box -->
        </div><!-- /.col -->
        </div><!-- /.row -->
    </section>
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

