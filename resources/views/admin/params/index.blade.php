@extends('admin.layout.home')



@section('content')

    <div class="users_page">

        <!--script src="{{ asset('admin/ajax/mails/index.js') }}" type="text/javascript"></script-->
        <link href="{{ asset('admin/css/search.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/css/tableParams.css') }}" rel="stylesheet" type="text/css" />



        <script>
            $(function() {
                var availableTags = [
                    @foreach($params as $row)
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
                Paramètre
                <small>Liste</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ ucfirst(route('bo')) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Paramètre</li>
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
                        {!! Form::open(array('url' => route('params.search'), 'class'=>'search-form')) !!}
                        <div class="form-group has-feedback">
                            <label for="search" class="sr-only">Search</label>
                            <input type="text" class="form-control" name="search" id="search" placeholder="search">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                        {!! Form::close() !!}

                    </div><!-- /.box-header -->


                    <div class="container">
                        <div class="row col-md-10 col-md-offset-0 custyle">
                            <table class="table table-striped custab">
                                <thead>
                                <a href="{{route('params.create')}}" class="btn btn-primary btn-xs pull-right"><b>+</b> Ajout nouveau paramètre</a>
                                <tr>
                                    <th>ID</th>
                                    <th>Langue</th>
                                    <th>Code</th>
                                    <th>Libelle</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                @foreach($params as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->langue->libelle}}</td>
                                        <td>{{$row->code}}</td>
                                        <td>{{$row->libelle}}</td>
                                        <td>{!! $row->status==1?'<span class="label label-success">Actif</span>':'<span class="label label-danger">Inactif</span>'!!}</td>
                                        <td class="text-center"><a class='btn btn-info btn-xs' href="#"><span class="glyphicon glyphicon-edit"></span> Edit</a> <a href="#" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Del</a></td>
                                    </tr>
                                @endforeach
                            </table>


                            <div style="margin-left: 40%;" class="paginate">
                                {!! $params->render() !!}
                            </div>


                        </div>
                    </div>




                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->


    </div>




@stop