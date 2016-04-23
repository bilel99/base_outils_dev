@extends('admin.layout.home')



@section('content')

    <script src="{{ asset('admin/ajax/actu/actu.js') }}" type="text/javascript"></script>
    <link href="{{ asset('admin/css/search.css') }}" rel="stylesheet" type="text/css" />



    <script>
        $(function() {
            var availableTags = [
                @foreach($actu as $row)
                "{{$row->titre}}",
                @endforeach
            ];
            console.log(availableTags);
            $( "#search" ).autocomplete({
                source: availableTags
            });
        });
    </script>


    <section class="content-header">
        <h1>
            Actualités
            <small>Liste</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ ucfirst(route('bo')) }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Actualités</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div>
                    @include('admin.layout.success')

                </div>

                <div class="box-header" style="overflow: auto;">
                    {!! Form::open(array('url' => route('actu.search'), 'class'=>'search-form')) !!}
                        <div class="form-group has-feedback">
                            <label for="search" class="sr-only">Search</label>
                            <input type="text" class="form-control" name="search" id="search" placeholder="search">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    {!! Form::close() !!}

                </div><!-- /.box-header -->

                <div id="table1">
                    <div class="box-body" style="overflow: auto;">
                        <table class="datatable table table-bordered table-striped" style="overflow: auto;" >
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>langue</th>
                                <th>users</th>
                                <th>titre</th>
                                <th>description</th>
                                <th>statut</th>
                                <th>created_at</th>

                                <th></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>langue</th>
                                <th>users</th>
                                <th>titre</th>
                                <th>description</th>
                                <th>statut</th>
                                <th>created_at</th>

                                <th></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($actu as $row)
                                <tr data-id="{{$row->id}}">
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->libelle}}</td>
                                    <td>{{substr($row->nom, 0, 1)}} {{$row->prenom}}</td>
                                    <td>{{$row->titre}}</td>
                                    <td>{!! mb_strimwidth( $row->description, 0, 50, "...") !!}</td>
                                    <td>{{$row->statut}}</td>
                                    <td>{{$row->created_at}}</td>

                                    <td>
                                        <a class="btn btn-primary glyphicon glyphicon-edit" href="{{ route('actu.edit', $row->id) }}"></a>
                                        <!--button type="submit" class="btn btn-danger glyphicon glyphicon-trash " data-toggle="modal" data-target="#{{ $row->id  }}"></button-->
                                        <button type="submit" class="btn btn-info glyphicon glyphicon-zoom-in " data-toggle="modal" data-target="#{{ $row->id  }}"></button>

                                        <!-- AJAX Change status, 1 ou 0 'Actif'|'Inactif' -->
                                        @if($row->statut == 'Actif')
                                            {!! Form::open(['route'=>['actu.destroy', ':ACTU_ID'], 'method' => 'DELETE', 'id'=>'form-delete']) !!}
                                            <a style="margin-left: 20px;" href="#" class="btn btn-danger glyphicon glyphicon-trash btn-delete"></a>
                                            {!! Form::close() !!}
                                        @elseif($row->statut == 'Archivé')
                                            {!! Form::open(['route'=>['actu.actif', ':ACTU_ID'], 'method' => 'ACTIF', 'id'=>'form-actif']) !!}
                                            <a style="margin-left: 20px;" href="#" class="btn btn-success glyphicon glyphicon-ok btn-actif"></a>
                                            {!! Form::close() !!}
                                        @endif
                                    </td>
                                </tr>





                                <!-- Modal View -->
                                <div class="modal fade" id="{{ $row->id  }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Actu : {{$row->id}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Info actu</p>
                                                <p>Titre : {{$row->titre}}</p>
                                                <p>Description : {!!$row->description!!}</p>
                                                <p>écrit le : {{$row->created_at}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- Fin Modal -->

                            @endforeach


                            </tbody>
                        </table>
                        <div style="margin-left: 40%;" class="paginate">
                            {!!$actu->render()!!}
                        </div>
                    </div><!-- /.box-body -->
                </div>


            </div><!-- /.box -->
        </div><!-- /.col -->
        </div><!-- /.row -->



    </section>

@stop

