@extends('admin.layout.home')



@section('content')

    <script src="{{ asset('admin/ajax/mailsHistorique/delete.js') }}" type="text/javascript"></script>


    <section class="content-header">
        <h1>
            Historiques des mails envoyés
            <small>Liste</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ ucfirst(route('bo')) }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Historiques des mails</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                @if(count($mailsHistorique) != 0)
                    <div>
                        @include('admin.layout.success')
                        <script src="{{ asset('plugins/notificationJs/notie.js') }}" type="text/javascript"></script>
                        <div id="message_info"></div>
                    </div>
                @endif

                <div id="btn_delete">
                    {!! Form::open(array('route' => array('mailsHistorique.deleteAll'), 'method' => 'post', 'id'=>'form-delete')) !!}
                    <center><a type="submit" class="fa fa-trash-o fa-2x btn-delete"></a></center>
                    {!!  Form::close() !!}
                </div>

                <div id="table1">
                    <div class="box-body" style="overflow: auto;">
                        <table class="datatable table table-bordered table-striped" id="tblCustomers" style="overflow: auto;" >
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>langues</th>
                                <th>type</th>
                                <th>Nom</th>
                                <th>exp_nom</th>
                                <th>exp_email</th>
                                <th>sujet</th>
                                <th>created_at</th>
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
                                <th>created_at</th>
                            </tr>
                            </tfoot>
                            <tbody id="content_show">
                            @foreach($mailsHistorique as $row)
                                <tr data-id="{{$row->id}}" id="trashTr_<?=$row->id?>">
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->langues->libelle}}</td>
                                    <td>{{$row->type}}</td>
                                    <td>{{$row->nom}}</td>
                                    <td>{{$row->exp_nom}}</td>
                                    <td>{{$row->exp_email}}</td>
                                    <td>{{$row->sujet}}</td>
                                    <td>{{\App\Http\Controllers\Admin\AdminPageController::instanced()->formatDateComplete($row->created_at)}}</td>


                                    <td>
                                        <a type="submit" class="fa fa-eye fa-2x" data-toggle="modal" data-target="#{{ $row->id  }}"></a><br />
                                        <!-- AJAX delete -->



                                        <div id="trash_<?=$row->id?>" style="display: none;">
                                            {!! Form::open(['route'=>['mailsHistorique.destroy', ':MAILSHISTORIQUE_ID'], 'method' => 'DELETE', 'id'=>'form-delete2']) !!}
                                            <a style="margin-left: 0px;" href="#" class="fa fa-trash-o fa-2x btn-delete2"></a>
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
                                                            email Expéditeur : {{$row->exp_email}}
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
                        <div style="margin-left: 40%;" class="paginate" id="paginate_show">
                            {!!$mailsHistorique->render()!!}
                        </div>
                    </div><!-- /.box-body -->
                </div>


            </div><!-- /.box -->
        </div><!-- /.col -->
        </div><!-- /.row -->



    </section>

@stop

