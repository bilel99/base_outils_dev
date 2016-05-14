@extends('admin.layout.home')



@section('content')

    <div class="users_page">

    <script src="{{ asset('admin/ajax/mails/index.js') }}" type="text/javascript"></script>
    <link href="{{ asset('admin/css/search.css') }}" rel="stylesheet" type="text/css" />



    <script>
        $(function() {
            var availableTags = [
                @foreach($mails as $row)
                "{{$row->nom}}",
                "{{$row->type}}",
                "{{$row->sujet}}",
                @endforeach
            ];
            $( "#search" ).autocomplete({
                source: availableTags
            });
        });
    </script>


    <section class="content-header">
        <h1>
            Mails
            <small>Liste</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ ucfirst(route('bo')) }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mails</li>
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
                    {!! Form::open(array('url' => route('mails.search'), 'class'=>'search-form')) !!}
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
                                    <th>langues</th>
                                    <th>type</th>
                                    <th>Nom</th>
                                    <th>exp_nom</th>
                                    <th>exp_email</th>
                                    <th>sujet</th>
                                    <th>statut</th>
                                    <th>created_at</th>

                                    <th></th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>langues</th>
                                    <th>type</th>
                                    <th>Nom</th>
                                    <th>exp_nom</th>
                                    <th>exp_email</th>
                                    <th>sujet</th>
                                    <th>statut</th>
                                    <th>created_at</th>

                                    <th></th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($mails as $row)

                                    <tr data-id="{{$row->id}}">
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->langues->libelle}}</td>
                                        <td>{{$row->type}}</td>
                                        <td>{{$row->nom}}</td>
                                        <td>{{$row->exp_nom}}</td>
                                        <td>{{$row->exp_email}}</td>
                                        <td>{{$row->sujet}}</td>
                                        <td id="statut_<?=$row->id?>">{{$row->statut}}</td>
                                        <td>{{\App\Http\Controllers\Admin\AdminPageController::instanced()->formatDateComplete($row->created_at)}}</td>

                                        <td>
                                            <a class="fa fa-pencil-square-o fa-2x" href="{{ route('mails.edit', $row->id) }}"></a><br />
                                            <!--button type="submit" class="btn btn-danger glyphicon glyphicon-trash " data-toggle="modal" data-target="#{{ $row->id  }}"></button-->
                                            <a type="submit" class="fa fa-eye fa-2x" data-toggle="modal" data-target="#{{ $row->id  }}"></a><br />
                                            <!-- AJAX Change status, 1 ou 0 'Actif'|'Inactif' -->



                                            <div id="trash_<?=$row->id?>" style="display: none;">
                                                {!! Form::open(['route'=>['mails.destroy', ':MAILS_ID'], 'method' => 'DELETE', 'id'=>'form-delete']) !!}
                                                <a style="margin-left: 0px;" href="#" class="fa fa-trash-o fa-2x btn-delete"></a>
                                                {!! Form::close() !!}
                                            </div>

                                            <div id="valable_<?=$row->id?>" style="display: none;">
                                                {!! Form::open(['route'=>['mails.actif', ':MAILS_ID'], 'method' => 'ACTIF', 'id'=>'form-actif']) !!}
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
                                                    <h4 class="modal-title">MAIL : {{$row->nom}}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <center>
                                                        {!! HTML::image(asset('img/admin/mail_mat_des.png'), 'avatar', array('class' => 'img-circle img-responsive', 'style'=>'max-height:85px', 'alt'=>'mails')) !!}
                                                        <h3 class="media-heading">{{$row->sujet}}
                                                            <small>
                                                                nom de l'Expéditeur : {{$row->exp_nom}}<br />
                                                                email Expéditeur : {{$row->exp_email}}<br />
                                                                statut : {{$row->statut == 'Actif'?'Actif':'inactif'}}
                                                            </small>
                                                        </h3>
                                                    </center>
                                                    <hr>
                                                    <p style="text-align: center;">{{$row->contenue}}</p>
                                                    <small>
                                                        date de création : {{\App\Http\Controllers\Admin\AdminPageController::instanced()->formatDateComplete($row->created_at)}}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                @endforeach


                                </tbody>
                            </table>
                            <div style="margin-left: 40%;" class="paginate">
                                {!! $mails->render() !!}
                            </div>
                        </div><!-- /.box-body -->
                    </div>




            </div><!-- /.box -->
        </div><!-- /.col -->
        </div><!-- /.row -->


    </div>




@stop