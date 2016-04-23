<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <?php
            $size = 40;
            $default = "";
            $gravatar = "http://www.gravatar.com/avatar/" . md5( strtolower( trim(Auth::user()->email))) . "?d=" . urlencode($default) . "&s=" . $size;
            ?>
            {!! HTML::image($gravatar, 'avatar', array('class' => 'img-circle img-responsive', 'alt'=>'user avatar')) !!}
            {{-- HTML::image(Auth::user()->avatar, 'avatar', array('class' => 'img-circle img-responsive', 'alt'=>'user avatar')) --}}
        </div>
        <div class="pull-left info">
            <p>{{substr(Auth::user()->nom, 0, 1)}} {{Auth::user()->prenom}}</p>

            <a href=""><i class="fa fa-circle text-success"></i> Retour sur le site web</a>
        </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">{{\Config::get('constante.nom_code')}}</li>



        <li class="treeview">
            <a href="#">
                <i class="fa fa-user"></i> <span>Membres</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="{{ route('users.index') }}"><i class="fa fa-list"></i>Liste</a></li>
                <li><a href="{{ route('users.create') }}"><i class="fa fa-plus-circle"></i>Ajouter</a></li>
            </ul>
        </li>



        <li class="treeview">
            <a href="#">
                <i class="fa fa-language"></i> <span>Gestion de la langue</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="{{route('gestionLanguage.index')}}"><i class="fa fa-list"></i>Liste</a></li>
            </ul>
        </li>




        <li class="treeview">
            <a href="#">
                <i class="fa fa-exclamation"></i> <span>Notifications</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="{{route('notifications.index')}}"><i class="fa fa-list"></i>Liste</a></li>
            </ul>
        </li>













        <li class="treeview">
            <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li>
                    <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                        <li>
                            <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            </ul>
        </li>

    </ul>
</section>
<!-- /.sidebar -->