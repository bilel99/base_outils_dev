@extends('admin.layout.home')



@section('content')

    <div class="users_page">

        <!--script src="{{ asset('admin/ajax/params/index.js') }}" type="text/javascript"></script-->
        <link href="{{ asset('admin/css/tree.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('admin/js/tree.js') }}" type="text/javascript"></script>



        <section class="content-header">
            <h1>
                TREE
                <small>Liste</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ ucfirst(route('bo')) }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Tree</li>
            </ol>
        </section>





        <div class="col-md-8 col-md-offset-2">
            <div class="well" style="padding: 8px;">
                <ul class="nav nav-list">
                    <li>
                        <label class="tree-toggler nav-header">
                            <b>
                                Arborescence des pages
                            </b>
                        </label>
                        <ul class="nav nav-list tree" style="display: block;">

                            <li>
                                <label class="tree-toggler nav-header">
                                    <b>
                                        HOME
                                    </b>
                                </label>
                                <ul class="nav nav-list tree">
                                    <li>
                                        <a href="#">
                                            Test
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <label class="tree-toggler nav-header">
                                    <b>
                                        PRODUIT
                                    </b>
                                </label>
                                <ul class="nav nav-list tree">
                                    <li>
                                        <a href="#">
                                            CATEGORIE
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            AJOUT
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            UPDATE
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            ETC...
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <label class="tree-toggler nav-header">
                                    <b>
                                        ACTU
                                    </b>
                                </label>
                                <ul class="nav nav-list tree">
                                    <li>
                                        <a href="#">
                                            Test
                                        </a>
                                    </li>
                                </ul>
                            </li>


                        </ul>
                    </li>
                </ul>
            </div>
        </div>








    </div>




@stop