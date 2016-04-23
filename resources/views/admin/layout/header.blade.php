<!-- Import de lib -->

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>






<style>
    .imgH{
        margin-left: 80px;
    }
</style>


<!-- Logo -->
<a href="index2.html" class="logo">
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
                    <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">You have 10 notifications</li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            <li>
                                <a href="#">
                                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-users text-red"></i> 5 new members joined
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-user text-red"></i> You changed your username
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="footer"><a href="#">View all</a></li>
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








