@extends('admin.layout.home')

@section('content')

    <style>
        .ds-btn li{ list-style:none; float:left; padding:10px; }
        .ds-btn li a span{padding-left:15px;padding-right:5px;width:100%;display:inline-block; text-align:left;}
        .ds-btn li a span small{width:100%; display:inline-block; text-align:left;}

    </style>


    <div class="users_page">

        <section class="content-header">
            <h1>
                Envoie de mails
                <small>Liste</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ ucfirst(route('bo')) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Envoie de mails</li>
            </ol>
        </section>


        <!-- Main content -->
        <div class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div>
                        @include('admin.layout.error')
                        @include('admin.layout.errors_request')
                        @include('admin.layout.success')

                        <script src="{{ asset('plugins/notificationJs/notie.js') }}" type="text/javascript"></script>
                        <div id="message_info"></div>
                    </div>



                    <ul class="ds-btn">
                        <li>
                            <a class="btn btn-lg btn-primary" data-toggle="modal" data-target="#envoieAll">
                                <i class="fa fa-paper-plane-o pull-left"></i><span>Envoie de mails global<br><small>à tous le mondes</small></span></a>

                        </li>
                        <li>
                            <a class="btn btn-lg btn-success " href="">
                                <i class="fa fa-envelope-o pull-left"></i><span>Envoie de mails personnalisé<br><small>à certaines personnes</small></span></a>

                        </li>
                        <li>
                            <a class="btn btn-lg btn-danger" href="">
                                <i class="fa fa-hourglass-end pull-left"></i><span>Envoie de mails pré-définie<br><small>Configuration de crons</small></span></a>

                        </li>
                    </ul>





                    <div class="modal fade" id="envoieAll" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Envoie d'un mail à tous les utilisateurs</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Message ici</p>


                                    {!! Form::open(['method' => 'post', 'url' => route('envoieMails.all')]) !!}
                                        {!! Form::label('sujet', 'Sujet *', array('class' => 'col-md-4 col-md-offset-4 control-label')) !!}
                                        <input type="text" name="sujet" placeholder="sujet" class="form-control" required />

                                        {!! Form::label('objet', 'Objet *', array('class' => 'col-md-4 col-md-offset-4 control-label')) !!}
                                        <input type="text" name="objet" id="objet" placeholder="Objet" class="form-control" required />

                                        {!! Form::label('expediteur', 'Expéditeur *', array('class' => 'col-md-4 col-md-offset-4 control-label')) !!}
                                        <input type="text" name="exp" id="exp" placeholder="Expéditeur" class="form-control" required />

                                        {!! Form::label('message', 'Message *', array('class' => 'col-md-4 col-md-offset-4 control-label')) !!}
                                        <textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Votre message ici" required></textarea>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                            <?=Form::submit('Envoyé', ['class' => 'btn btn-info', 'name' => 'send'])?>
                                        </div>
                                    {!! Form::close() !!}

                                </div>
                            </div>
                        </div>
                    </div>





                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->


    </div>




@stop