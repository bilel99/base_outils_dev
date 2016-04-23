<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GestionLanguageHome;
use App\Http\Requests\LanguageRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GestionLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        /**
         * Page template layout Design
         * A l'appuie d'un bouton
         * Création d'un fichier php dans le repertoir resources/lang/en et resources/lang/fr
         * List des fichier update avec btn update et delete 2 fichiers par groupe
         */

        // Lecture des fichiers index
        $dir_nom = '../resources/lang/fr'; // dossier listé (pour lister le répertoir courant : $dir_nom = '.'  --> ('point')
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
        }


        return View('admin.gestionLanguage.index', compact('fichier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        /**
         * Design
         * Gestion du fichier en lui même ajout des traduction à la fois en français et en english
         * traduction des fichier lang en tableau php et insertion des ligne php dans les fichiers crée précédemment
         */


        return View('admin.gestionLanguage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(LanguageRequest $request)
    {
        /**
         * Une fois valider mettre à jour les fichiers de langues faire ce qui est marquer au dessus
         */
        //dd($request->all());

        // Récupération des champs du formulaire
        $nom1 = $request->nom . '.php';
        $francais = $request->francais;
        $english = $request->english;
        $nom2 = $request->nom . '.php';


        // Création du fichier 1 en anglais
        $fichier1 = fopen("../resources/lang/en/" . $nom1, "w+");
        fwrite($fichier1, $english);
        fclose($fichier1);


        // Création du fichier 2 en français
        $fichier2 = fopen("../resources/lang/fr/" . $nom2, "w+");
        fwrite($fichier2, $francais);
        fclose($fichier2);


        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->title = 'Un fichier de langue FR/EN à été créer, '.$request->nom;
        $noti->description = 'pour voir le detail du fichier, je vous invite à vous rendre à la rubrique "gestion fichiers" ';
        $noti->status = 1;
        $noti->save();


        return redirect('gestionLanguage')->withFlashMessage("Création des fichiers de langues effectué avec succès");


    }


    /**
     * Function Mise à jour files languages
     */
    public function majfiles(GestionLanguageHome $request, $id){
        /**
         * A l'appuie sur le bouton
         * Modifier les fichiers de langues
         */
        $dir_nom = '../resources/lang/fr'; // dossier listé (pour lister le répertoir courant : $dir_nom = '.'  --> ('point')
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


        // Debut du processus de mise à jour
        foreach($fichier as $row => $f){
            if($f != '.DS_Store'){
                $fr = $request->francais;
                $en = $request->english;

                if($row == $id) {
                    // mise à jour des fichier en français
                    $fichier1 = fopen("../resources/lang/fr/" . $f, "w+");
                    fwrite($fichier1, $fr);
                    fclose($fichier1);


                    // mise à jour des fichier en anglais
                    $fichier2 = fopen("../resources/lang/en/" . $f, "w+");
                    fwrite($fichier2, $en);
                    fclose($fichier2);
                }
            }
        }



        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->title = 'Un fichier de langue FR/EN à été mis à jour, '.$request->nom;
        $noti->description = 'pour voir le detail du fichier, je vous invite à vous rendre à la rubrique "gestion fichiers" ';
        $noti->status = 1;
        $noti->save();


        return redirect('gestionLanguage')->withFlashMessage("Mise à jour des fichiers de langues effectué avec succès");
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show()
    {
        /**
         * Voir les fichiers de langues au complet
         */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit()
    {
        /**
         * Design
         * Modifier les fichiers de langues
         */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update()
    {
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        /**
         * Suppression des fichier de traduction Anglais - Français
         */
        $dir_nom = '../resources/lang/fr'; // dossier listé (pour lister le répertoir courant : $dir_nom = '.'  --> ('point')
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


        // Debut du processus de suppression
        foreach ($fichier as $row => $f) {
            if ($f != '.DS_Store') {
                if($row == $id) {
                    $fichier = '../resources/lang/fr/' . $f;
                    if (file_exists($fichier)){
                        unlink($fichier);
                    }
                }
            }

            if ($f != '.DS_Store') {
                if($row == $id) {
                    $fichier = '../resources/lang/en/' . $f;
                    if (file_exists($fichier)) {
                        unlink($fichier);
                    }
                }
            }
        }


        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->title = 'Un fichier de langue FR/EN à été supprimé';
        $noti->description = 'La suppression à bien été effectuée en FR/EN ';
        $noti->status = 1;
        $noti->save();


        return redirect('gestionLanguage')->withFlashMessage("Suppression du fichier de langue En/Fr effectué avec succès");
    }
}
