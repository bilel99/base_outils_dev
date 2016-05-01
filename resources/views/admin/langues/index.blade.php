@extends('admin.layout.home')



@section('content')

    <div class="users_page">

        <script src="{{ asset('admin/ajax/langue/index.js') }}" type="text/javascript"></script>
        <link href="{{ asset('admin/css/search.css') }}" rel="stylesheet" type="text/css" />



        <script>
            $(function() {
                var availableTags = [
                    @foreach($langue as $row)
                            "{{$row->libelle}}",
                    @endforeach
                ];
                $( "#search" ).autocomplete({
                    source: availableTags
                });
            });
        </script>


        <section class="content-header">
            <h1>
                Langues
                <small>Liste</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ ucfirst(route('bo')) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Langues</li>
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
                        {!! Form::open(array('url' => route('langues.search'), 'class'=>'search-form')) !!}
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
                                    <th>code</th>
                                    <th>libelle</th>
                                    <th>created_at</th>

                                    <th></th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>code</th>
                                    <th>libelle</th>
                                    <th>created_at</th>

                                    <th></th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($langue as $row)

                                    <tr data-id="{{$row->id}}" id="delete_row{{$row->id}}">
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->code}}</td>
                                        <td>{{$row->libelle}}</td>
                                        <td>{{$row->created_at}}</td>

                                        <td>
                                            <a class="fa fa-pencil-square-o fa-2x" href="{{ route('langues.edit', $row->id) }}"></a><br />

                                            <div id="trash_<?=$row->id?>" style="display: none;">
                                                {!! Form::open(['route'=>['langues.destroy', ':LANGUE_ID'], 'method' => 'DELETE', 'id'=>'form-delete']) !!}
                                                <a style="margin-left: 0px;" href="#" class="fa fa-trash-o fa-2x btn-delete"></a>
                                                {!! Form::close() !!}
                                            </div>


                                        </td>
                                    </tr>

                                @endforeach


                                </tbody>
                            </table>
                            <div style="margin-left: 40%;" class="paginate">
                                {!! $langue->render() !!}
                            </div>
                        </div><!-- /.box-body -->
                    </div>




                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->


    </div>




@stop