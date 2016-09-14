<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TreeController extends Controller
{

    /**
     * Création d'un controller sur Front (le faire avec éxécution de commande php artisan make:controller Front/NameController avec PHP
     *  +
     * Création d'un dossier qui porte le meme nom que le controller
     *  +
     * Création d'un fichier index.blade.php
     *
     *
     * Création d'une page avec formulaire nom, slug, tree etc ... enregistrement sur une table
     * SLUG unique
     * Tree = Parent, enfant
     * 0 = Parent, 1 = enfant etc ...
     * Modification de la page
     * + Réorganisation du tree
     * Une page peux être parent de d'autre page exemple
     * Page index => Parent
     * Page create, Edit, autre => Enfant du parent
     */



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Lecture des fichiers présent sur controller / Front
        $dir_nom = '../app/Http/Controllers/Front'; // dossier listé (pour lister le répertoir courant : $dir_nom = '.'  --> ('point')
        $dir = opendir($dir_nom) or die('Erreur de listage : le répertoire n\'existe pas'); // on ouvre le contenu du dossier courant
        $fichier = array(); // on déclare le tableau contenant le nom des fichiers

        while ($element = readdir($dir)) {
            if ($element != '.' && $element != '..') {
                if (!is_dir($dir_nom . '/' . $element)) {
                    $fichier[] = $element;
                } else {
                    $dossier[] = $element;
                }
            }
        }

        closedir($dir);

        if (!empty($fichier)) {
            sort($fichier);// pour le tri croissant, rsort() pour le tri décroissant
            dd($fichier);
        }



        return view('admin.tree.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
