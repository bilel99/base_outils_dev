@extends('admin.layout.home')



@section('content')
    <link href="{{ asset('front/css/profili.css') }}" rel="stylesheet">


    <div class="container">
        <div class="row">

            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 toppad" >

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{$curriculumVitae->titre}}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 " align="center"> {!! HTML::image($curriculumVitae->image, 'Image CV', array('class' => 'img-circle img-responsive', 'alt'=>'Image CV')) !!} </div>

                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>écrit par :</td>
                                        <td>{{$curriculumVitae->user->nom}}</td>
                                    </tr>

                                    <tr>
                                        <td>écrit dans la langue :</td>
                                        <td>{{$curriculumVitae->langue->label}}</td>
                                    </tr>
                                    <tr>
                                        <td>nom :</td>
                                        <td>{{$curriculumVitae->nom}}</td>
                                    </tr>
                                    <tr>
                                        <td>prénom :</td>
                                        <td>{{$curriculumVitae->prenom}}</td>
                                    </tr>
                                    <tr>
                                        <td>adresse :</td>
                                        <td>{{$curriculumVitae->adresse}}</td>
                                    </tr>
                                    <tr>
                                        <td>ville :</td>
                                        <td>{{$curriculumVitae->ville}}</td>
                                    </tr>
                                    <tr>
                                        <td>numéro 1 :</td>
                                        <td>{{$curriculumVitae->num1}}</td>
                                    </tr>
                                    <tr>
                                        <td>numéro 2 :</td>
                                        <td>{{$curriculumVitae->num2}}</td>
                                    </tr>

                                    <tr>
                                        <td>email 1 :</td>
                                        <td>{{$curriculumVitae->email1}}</td>
                                    </tr>

                                    <tr>
                                        <td>email 2 :</td>
                                        <td>{{$curriculumVitae->email2}}</td>
                                    </tr>

                                    <tr>
                                        <td>age :</td>
                                        <td>{{$curriculumVitae->age}}</td>
                                    </tr>

                                    <tr>
                                        <td>situation :</td>
                                        <td>{{$curriculumVitae->situation}}</td>
                                    </tr>

                                    <tr>
                                        <td>nationalité :</td>
                                        <td>{{$curriculumVitae->nationalite}}</td>
                                    </tr>

                                    <tr>
                                        <td>permis :</td>
                                        <td>{{$curriculumVitae->permis}}</td>
                                    </tr>

                                    <tr>
                                        <td>titre :</td>
                                        <td>{{$curriculumVitae->titre}}</td>
                                    </tr>

                                    <tr>
                                        <td>formation :</td>
                                        <td>{{$curriculumVitae->formation}}</td>
                                    </tr>

                                    <tr>
                                        <td>date formation :</td>
                                        <td>{{$curriculumVitae->formation_date}}</td>
                                    </tr>

                                    <tr>
                                        <td>competence :</td>
                                        <td>{{$curriculumVitae->competence}}</td>
                                    </tr>

                                    <tr>
                                        <td>experience :</td>
                                        <td>{{$curriculumVitae->experience}}</td>
                                    </tr>

                                    <tr>
                                        <td>date experience :</td>
                                        <td>{{$curriculumVitae->experience_date}}</td>
                                    </tr>

                                    <tr>
                                        <td>language :</td>
                                        <td>{{$curriculumVitae->language}}</td>
                                    </tr>

                                    <tr>
                                        <td>interet :</td>
                                        <td>{{$curriculumVitae->interet}}</td>
                                    </tr>

                                    <tr>
                                        <td>description :</td>
                                        <td>{{$curriculumVitae->description}}</td>
                                    </tr>

                                    <tr>
                                        <td>about :</td>
                                        <td>{{$curriculumVitae->about}}</td>
                                    </tr>

                                    <tr>
                                        <td>Compétence individuel :</td>
                                        <td>{{$curriculumVitae->comp1}}</td>
                                    </tr>

                                    <tr>
                                        <td>Compétence individuel 2 :</td>
                                        <td>{{$curriculumVitae->comp2}}</td>
                                    </tr>

                                    <tr>
                                        <td>Compétence individuel 3 :</td>
                                        <td>{{$curriculumVitae->comp3}}</td>
                                    </tr>

                                    <tr>
                                        <td>Compétence individuel 4 :</td>
                                        <td>{{$curriculumVitae->comp4}}</td>
                                    </tr>

                                    <tr>
                                        <td>Compétence individuel 5 :</td>
                                        <td>{{$curriculumVitae->comp5}}</td>
                                    </tr>






                                    <tr>
                                        <td>Crée le :</td>
                                        <td>{{$curriculumVitae->created_at}}</td>
                                    </tr>

                                    <tr>
                                    <tr>
                                        <td>Modifié le :</td>
                                        <td>{{$curriculumVitae->updated_at}}</td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a class="btn btn-primary" href="{{URL::previous()}}"><span class="fa fa-chevron-circle-left fa-lg"></span></a>
                        <span class="pull-right">

                        </span>
                    </div>



                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('front/js/profili.js') }}"></script>
@stop

