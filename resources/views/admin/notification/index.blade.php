@extends('admin.layout.home')



@section('content')

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

                </div>

                <div id="table1">
                    <div class="box-body" style="overflow: auto;">
                        <table class="datatable table table-bordered table-striped" style="overflow: auto;" >
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
                            <tbody>
                            @foreach($notif as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{substr($row->nom, 0, 1)}} {{$row->prenom}}</td>
                                    <td>{{$row->title}}</td>
                                    <td>{!! mb_strimwidth( $row->description, 0, 50, "...") !!}</td>
                                    <td>{{$row->status}}</td>
                                    <td>{{$row->created_at}}</td>
                                </tr>

                            @endforeach

                            {!! Form::open(array('route' => array('notifications.deleteAll'), 'method' => 'put')) !!}
                            <center><a type="submit" class="fa fa-archive fa-2x "></a></center>
                            {!!  Form::close() !!}

                            </tbody>
                        </table>
                        <div style="margin-left: 40%;" class="paginate">
                            {!!$notif->render()!!}
                        </div>
                    </div><!-- /.box-body -->
                </div>


            </div><!-- /.box -->
        </div><!-- /.col -->
        </div><!-- /.row -->



    </section>

@stop

