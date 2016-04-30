@extends('admin.layout.home')



@section('content')

    <div class="users_page">

    <script src="{{ asset('admin/ajax/users/index_users.js') }}" type="text/javascript"></script>
    <link href="{{ asset('admin/css/search.css') }}" rel="stylesheet" type="text/css" />



    <script>
        $(function() {
            var availableTags = [
                @foreach($users as $row)
                "{{$row->nom}}",
                "{{$row->prenom}}",
                "{{$row->email}}",
                @endforeach
            ];
            $( "#search" ).autocomplete({
                source: availableTags
            });
        });
    </script>


    <section class="content-header">
        <h1>
            Users
            <small>Liste</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ ucfirst(route('bo')) }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users</li>
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

                <div class="box-header" style="overflow: auto;">
                    {!! Form::open(array('url' => route('users.search'), 'class'=>'search-form')) !!}
                        <div class="form-group has-feedback">
                            <label for="search" class="sr-only">Search</label>
                            <input type="text" class="form-control" name="search" id="search" placeholder="search">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    {!! Form::close() !!}

                </div><!-- /.box-header -->


                    <div id="table1">
                        <div class="box-body" style="overflow: auto;">
                            <table class="datatable table table-bordered table-striped" style="overflow: auto;" id="matable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ville</th>
                                    <th>role</th>
                                    <th>nom prénom</th>
                                    <th>email</th>
                                    <th>adresse</th>
                                    <th>phone</th>
                                    <th>status</th>
                                    <th>created_at</th>

                                    <th></th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>ville</th>
                                    <th>role</th>
                                    <th>nom prénom</th>
                                    <th>email</th>
                                    <th>adresse</th>
                                    <th>phone</th>
                                    <th>status</th>
                                    <th>created_at</th>

                                    <th></th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($users as $row)

                                    <tr data-id="{{$row->id}}">
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->id_villes==NULL?'?':$row->ville->libelle}}</td>
                                        <td>{{$row->role->libelle}}</td>
                                        <td>{{substr($row->nom, 0, 1)}} {{$row->prenom}}</td>
                                        <td>{{$row->email}}</td>
                                        <td>{{$row->adresse}}</td>
                                        <td>{{$row->telephone}}</td>
                                        <td id="statut_<?=$row->id?>">{{$row->statut}}</td>
                                        <td>{{$row->created_at}}</td>

                                        <td>
                                            <a class="fa fa-pencil-square-o fa-2x" href="{{ route('users.edit', $row->id) }}"></a><br />
                                            <!--button type="submit" class="btn btn-danger glyphicon glyphicon-trash " data-toggle="modal" data-target="#{{ $row->id  }}"></button-->
                                            <a type="submit" class="fa fa-eye fa-2x" data-toggle="modal" data-target="#{{ $row->id  }}"></a><br />
                                            <!-- AJAX Change status, 1 ou 0 'Actif'|'Inactif' -->

                                            <!-- Mise à jour de password, si admin password personnalisé, si user password générer + envoie mail au utilisateur la mise à jour -->
                                            <a type="submit" class="fa fa-key fa-2x" data-toggle="modal" data-target="#password-{{ $row->id  }}"></a>
                                            <!-- FIN -->






                                            <div id="trash_<?=$row->id?>" style="display: none;">
                                                {!! Form::open(['route'=>['users.destroy', ':USERS_ID'], 'method' => 'DELETE', 'id'=>'form-delete']) !!}
                                                <a style="margin-left: 0px;" href="#" class="fa fa-trash-o fa-2x btn-delete"></a>
                                                {!! Form::close() !!}
                                            </div>

                                            <div id="valable_<?=$row->id?>" style="display: none;">
                                                {!! Form::open(['route'=>['users.actif', ':USERS_ID'], 'method' => 'ACTIF', 'id'=>'form-actif']) !!}
                                                <a style="margin-left: 0px;" href="#" class="fa fa-thumbs-o-up fa-2x btn-actif"></a>
                                                {!! Form::close() !!}
                                            </div>








                                        </td>
                                    </tr>

                                    {{-- Popup show --}}
                                    <div class="modal fade" id="{{ $row->id  }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Utilisateurs : {{substr($row->nom, 0, 1).' '.$row->prenom}}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <center>
                                                        <?php
                                                        $size = 150;
                                                        $default = "";
                                                        $gravatar = "http://www.gravatar.com/avatar/" . md5( strtolower( trim($row->email))) . "?d=" . urlencode($default) . "&s=" . $size;
                                                        ?>
                                                        {!! HTML::image($gravatar, 'avatar', array('class' => 'img-circle img-responsive', 'alt'=>'avatar '.$row->nom.' '.$row->prenom)) !!}
                                                        <h3 class="media-heading">{{$row->nom.' '.$row->prenom}}
                                                            <small>
                                                                <?php if($row->id_villes == NULL) '' ?>
                                                                @foreach($ville as $v)
                                                                    @if($row->id_villes == $v->id)
                                                                        {{$v->libelle}}
                                                                    @endif
                                                                @endforeach
                                                            </small>
                                                        </h3>
                                                    </center>
                                                    <hr>
                                                    <center>
                                                        <p>Utilisateurs : {{substr($row->nom, 0, 1).' '.$row->prenom}}</p>
                                                        <p>nom : {{$row->nom}}</p>
                                                        <p>prenom : {{$row->prenom}}</p>
                                                        <p>mail : {{$row->email}}</p>
                                                        <p>adresse : {{$row->adresse}}</p>
                                                        <p>telephone : {{$row->telephone}}</p>
                                                        <p>statut : {{$row->statut}}</p>
                                                        <p>écrit le : {{$row->created_at}}</p>
                                                        <br>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                    {{-- Popup gestion password --}}
                                    <div class="modal fade" id="password-{{ $row->id  }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Gestion des mots de passes</h4>
                                                </div>
                                                <div class="modal-body">
                                                    @if($row->role->libelle == 'Users')
                                                        <p>Envoie d'un mail avec le nouveau mot de passe</p>
                                                    @elseif($row->role->libelle == 'Admin')
                                                        <p>Merci de saisir votre nouveau mot de passe</p>
                                                    @endif
                                                    <hr>
                                                    {!! Form::open(['method' => 'put', 'url' => route('utilisateur.gestion_password', $row->id) ]) !!}
                                                        @if($row->role->libelle == 'Users')
                                                        {{-- Envoie mail --}}
                                                            <center><span><?php echo Form::submit('envoie du mail', ['class' => 'btn btn-info', 'name' => 'envoie_mail']); ?></span></center>
                                                        @elseif($row->role->libelle == 'Admin')
                                                        {{-- formulaire de modification --}}
                                                            {!! Form::label('password', 'mot de passe *', array('class' => 'col-md-4 col-md-offset-4 control-label')) !!}
                                                            {!! Form::password('password', array('class'=>'form-control', 'name'=>'password', 'placeholder' => 'password', 'required'=>'required')) !!}

                                                            {!! Form::label('conf_password', 'je confirme mon mot de passe *', array('class' => 'col-md-6 col-md-offset-3 control-label')) !!}
                                                            {!! Form::password('conf_password', array('class'=>'form-control', 'name'=>'conf_password', 'placeholder' => 'password', 'required'=>'required')) !!}

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                                <?=Form::submit('Modifier', ['class' => 'btn btn-danger', 'name' => 'send'])?>
                                                            </div>
                                                        @endif


                                                    {!! Form::close() !!}

                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                @endforeach


                                </tbody>
                            </table>
                            <div style="margin-left: 40%;" class="paginate">
                                {!! $users->render() !!}
                            </div>
                        </div><!-- /.box-body -->
                    </div>




            </div><!-- /.box -->
        </div><!-- /.col -->
        </div><!-- /.row -->


    </div>




@stop