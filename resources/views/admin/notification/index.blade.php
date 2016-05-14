@extends('admin.layout.home')



@section('content')

    <script src="{{ asset('admin/ajax/notif/deleteNotif.js') }}" type="text/javascript"></script>


    <section class="content-header">
        <h1>
            Notifications
            <small>Liste</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ ucfirst(route('bo')) }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Notifications</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div>
                    @include('admin.layout.success')

                    <script src="{{ asset('plugins/notificationJs/notie.js') }}" type="text/javascript"></script>
                    <div id="message_info"></div>

                </div>

                <div id="btn_delete">
                    {!! Form::open(array('route' => array('notifications.deleteAll'), 'method' => 'post', 'id'=>'form-delete')) !!}
                    <center><a type="submit" class="fa fa-trash-o fa-2x btn-delete"></a></center>
                    {!!  Form::close() !!}
                </div>

                <div id="table1">
                    <div class="box-body" style="overflow: auto;">
                        <table class="datatable table table-bordered table-striped" id="tblCustomers" style="overflow: auto;" >
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>users</th>
                                <th>titre</th>
                                <th>description</th>
                                <th>status</th>
                                <th>created_at</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>users</th>
                                <th>titre</th>
                                <th>description</th>
                                <th>statut</th>
                                <th>created_at</th>
                            </tr>
                            </tfoot>
                            <tbody id="content_show">
                            @foreach($notif as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{substr($row->users->nom, 0, 1)}} {{$row->users->prenom}}</td>
                                    <td>{{$row->title}}</td>
                                    <td>{!! mb_strimwidth( $row->description, 0, 50, "...") !!}</td>
                                    <td>{{$row->status}}</td>
                                    <td>{{\App\Http\Controllers\Admin\AdminPageController::instanced()->formatDateComplete($row->created_at)}}</td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                        <div style="margin-left: 40%;" class="paginate" id="paginate_show">
                            {!!$notif->render()!!}
                        </div>
                    </div><!-- /.box-body -->
                </div>


            </div><!-- /.box -->
        </div><!-- /.col -->
        </div><!-- /.row -->



    </section>

@stop

