<!-- Import de lib -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!-- jQuery 2.1.3 -->
<script src="{{ asset('admin/AdminLTE-2.3.0/plugins/jQuery/jQuery2.1.3.min.js') }}"></script>
<!-- jQueryUI 1.11.4 -->
<script src="{{ asset('admin/AdminLTE-2.3.0/plugins/jQueryUI/jQueryUi1.11.4.min.js') }}"></script>






<style>
    .imgH{
        margin-left: 80px;
    }
</style>


<!-- Logo -->
<a href="{{route('bo')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>{{\Config::get('constante.nom_code_miniature')}}</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>{{\Config::get('constante.nom_code')}}</b></span>
</a>

<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>


    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

            <!-- Notifications: style can be found in dropdown.less -->
            <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <span class="label label-warning">{{count($notifications)}}</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">You have {{count($notifications)}} notifications</li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            @foreach($notifications as $row)
                                <li>
                                    <a href="{{route('notifications.index')}}">
                                        <i class="fa fa-warning text-yellow"></i> {{$row->title}}({{substr($row->users->nom, 0, 1)}} {{$row->users->prenom}})
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="footer"><a href="{{route('notifications.index')}}">View all</a></li>
                </ul>
            </li>


            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php
                    $size = 30;
                    $size_two = 120;
                    $default = "";
                    $gravatar = "http://www.gravatar.com/avatar/" . md5( strtolower( trim(Auth::user()->email))) . "?d=" . urlencode($default) . "&s=" . $size;
                    $gravatar_two = "http://www.gravatar.com/avatar/" . md5( strtolower( trim(Auth::user()->email))) . "?d=" . urlencode($default) . "&s=" . $size_two;
                    ?>
                    {!! HTML::image($gravatar, 'avatar', array('class' => 'user-image img-responsive', 'alt'=>'user avatar')) !!}
                    {{-- HTML::image(Auth::user()->avatar, 'avatar', array('class' => 'user-image img-responsive', 'alt'=>'User avatar')) --}}
                    <span class="hidden-xs">{{substr(Auth::user()->nom, 0, 1)}} {{Auth::user()->prenom}}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        {!! HTML::image($gravatar_two, 'avatar', array('class' => 'img-circle img-responsive imgH', 'alt'=>'user avatar')) !!}
                        {{-- HTML::image(Auth::user()->avatar, 'avatar', array('class' => 'img-circle img-responsive imgH', 'alt'=>'User avatar')) --}}
                        <p>
                            {{substr(Auth::user()->nom, 0, 1)}} {{Auth::user()->prenom}}
                            <small>Membre depuis le  {{Auth::user()->created_at}}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-right">
                            <a href="{{route('root.logout')}}" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
        </ul>
    </div>

</nav>
