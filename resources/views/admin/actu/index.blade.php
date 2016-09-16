@extends('admin.layout.home')



@section('content')

    <div class="users_page">

        <script src="{{ asset('admin/ajax/actu/index.js') }}" type="text/javascript"></script>
        <link href="{{ asset('admin/css/tableParams.css') }}" rel="stylesheet" type="text/css" />

    <section class="content-header">
        <h1>
            Actualités
            <small>Liste</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ ucfirst(route('bo')) }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Actualité</li>
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





                <div class="container">
                    <div class="row col-md-10 col-md-offset-0 custyle">
                        <table class="table table-striped custab">
                            <thead>
                            <a href="{{route('actu.create')}}" class="btn btn-primary btn-xs pull-right"><b>+</b> Ajout nouvelle actualité</a>
                            <tr>
                                <th>ID</th>
                                <th>Users</th>
                                <th>Langues</th>
                                <th>Libelle</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>created_at</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Users</th>
                                <th>Langues</th>
                                <th>Libelle</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>created_at</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($actu as $row)
                                <tr class="paramsLinter_{{$row->id}}" data-id="{{$row->id}}">
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->users->prenom.' '.$row->users->nom}}</td>
                                    <td>{{$row->langues->libelle}}</td>
                                    <td>{{$row->libelle}}</td>
                                    <td>{!! $row->description !!}</td>
                                    <td>{!! HTML::image($row->image, 'actu', array('class' => 'img-responsive img-circle', 'alt'=>'actu', 'width'=>'70', 'height'=>'70')) !!}</td>

                                    <td>

                                        <div id="innactif_<?=$row->id?>" style="display: none;">
                                            {!! Form::open(['route'=>['actu.statusOff', ':ACTU_ID'], 'method' => 'INNACTIF', 'id'=>'form-innactif']) !!}
                                            <a href="#" class="btn_innactif">
                                                <span class="label label-success">Actif</span>
                                            </a>
                                            {!! Form::close() !!}
                                        </div>


                                        <div id="actif_<?=$row->id?>" style="display: none;">
                                            {!! Form::open(['route'=>['actu.statusOn', ':ACTU_ID'], 'method' => 'ACTIF', 'id'=>'form-actif']) !!}
                                            <a href="#" class="btn_actif">
                                                <span class="label label-danger">Innactif</span>
                                            </a>
                                            {!! Form::close() !!}
                                        </div>

                                    </td>

                                    <td>{{\App\Http\Controllers\Admin\AdminPageController::instanced()->formatDateComplete($row->created_at)}}</td>

                                    <td class="text-center">
                                        <a class='btn btn-info btn-xs' href="{{route('actu.edit', $row->id)}}"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                        <a type="submit" class="fa fa-eye fa-2x" data-toggle="modal" data-target="#{{ $row->id  }}"></a>

                                        <div id="del_<?=$row->id?>">
                                            {!! Form::open(['route'=>['actu.del', ':ACTU_ID'], 'method' => 'DEL', 'id' => 'form-del']) !!}
                                            <a href="#" class="btn_del btn btn-danger btn-xs">
                                                <span class="glyphicon glyphicon-remove"></span>
                                                Del
                                            </a>
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
                                                <h4 class="modal-title">Actualité : {{$row->libelle}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <center>
                                                    {!! HTML::image($row->image, 'actu_img', array('class' => 'img-circle img-responsive', 'alt'=>'actu_img '.$row->libelle)) !!}
                                                </center>
                                                <hr>
                                                <center>
                                                    {!! $row->description !!}
                                                    <br>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </table>


                        <div style="margin-left: 40%;" class="paginate">
                            {!! $actu->render() !!}
                        </div>


                    </div>
                </div>






            </div><!-- /.box -->
        </div><!-- /.col -->
        </div><!-- /.row -->


    </div>




@stop