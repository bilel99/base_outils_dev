<?php

namespace App\Http\Controllers\Admin;

use App\Users;
use App\Http\Requests\UsersRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /* Recherche */
        $users = \App\Users::with('role', 'ville')
            ->where('nom', 'like', '%'.$request->search.'%')
            ->orWhere('prenom', 'like', '%'.$request->search.'%')
            ->orWhere('email', 'like', '%'.$request->search.'%')
            ->orWhere('id', 'like', '%'.$request->search.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $users->setPath('users');

        // Récupération de la ville et du pays
        $ville = \App\Villes::with('pays')
            ->get();



        $info = \App\Users::with('role', 'ville')->orderBy('created_at', 'desc')->get();
        $mavue = view('admin.users.pagination', compact('users', 'ville'))->render();
        if($request->ajax()){
            return response()->json([
                'info'     => $info,
                'mavue'    => $mavue
            ]);
        }

        return view('admin.users.index', compact('users', 'ville'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request){

        /* Recherche */
        $users = \App\Users::with('role', 'ville')
            ->where('nom', 'like', '%'.$request->search.'%')
            ->orWhere('prenom', 'like', '%'.$request->search.'%')
            ->orWhere('email', 'like', '%'.$request->search.'%')
            ->orWhere('id', 'like', '%'.$request->search.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $users->setPath('users');


        // Récupération de la ville et du pays
        $ville = \App\Villes::with('pays')
            ->get();



        // Recherche en AJAX
        if($request->ajax()){
            return response()->json([
                'search_users'  => $users,
                'search_ville'  => $ville
            ]);
        }
        // FIN


        return view('admin.users.index', compact('users', 'ville'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        // Récuperer list select
        $role = \App\Roles_users::lists('libelle', 'id');
        $ville = \App\Villes::lists('libelle', 'id');
        $pays = \App\Pays::lists('nom_fr_fr', 'id');



        $list_pays = \App\Pays::orderBy('created_at', 'desc')->get();
        $list_ville = \App\Villes::with('pays')->orderBy('created_at', 'desc')->get();
        if($request->ajax()){
            return response()->json([
                'pays'     => $list_pays,
                'villes'    => $list_ville
            ]);
        }


        return view('admin.users.create', compact('role', 'ville', 'pays'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(UsersRequest $request)
    {
        $users = new \App\Users;
        $users->id_villes = $request->id_ville;
        $users->id_roles_users = $request->id_role;
        $users->nom = $request->nom;
        $users->prenom = $request->prenom;
        $users->email = $request->email;
        $users->statut = 'Actif';

        // Avatar par default
        $users->avatar = '/img/users/default.jpg';

        // Générer un password par default
        $users->password = md5('password');

        $users->save();

        // Récupération de l'insertion précedente
        //$last_users = \App\Users::orderBy('id', 'desc')->limit(1)->get();
        $last_users = $users->id;

        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $last_users;
        $noti->title = 'Un utilisateurs à été créer, '.substr($request->nom,0, 1).' '.$request->prenom;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();

        return redirect('users')->withFlashMessage("Création effectué avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($users)
    {
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($users, Request $request)
    {
        // Récuperer list select
        $role = \App\Roles_users::lists('libelle', 'id');
        $ville = \App\Villes::lists('libelle', 'id');
        $pays = \App\Pays::lists('nom_fr_fr', 'id');

        $pays_choix = \App\Pays::where('id', '=', $users->ville->id_pays)->get();
        $ville_choix = \App\Villes::where('id', '=', $users->id_villes)->get();

        $list_pays = \App\Pays::orderBy('created_at', 'desc')->get();
        $list_ville = \App\Villes::with('pays')->orderBy('created_at', 'desc')->get();
        if($request->ajax()){
            return response()->json([
                'pays'     => $list_pays,
                'villes'    => $list_ville,
                'ville_choix' => $ville_choix
            ]);
        }

        return view('admin.users.edit', compact('users', 'role', 'ville', 'pays', 'pays_choix'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($users, UsersRequest $request)
    {
        $users->id_villes = $request->id_villes;
        $users->id_roles_users = $request->id_role;
        $users->nom = $request->nom;
        $users->prenom = $request->prenom;
        $users->email = $request->email;
        $users->save();

        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $users->id;
        $noti->title = 'Un utilisateur à été modifié, '.substr($request->nom, 0, 1).' '.$request->prenom;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();

        return redirect('users')->withFlashMessage("Mise à jours effectué avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($users, Request $request)
    {
        $users->statut = 2;
        $users->update();


        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $users->id;
        $noti->title = 'Un utilisateurs à été rendu inactif, '.substr($request->nom, 0, 1).' '.$request->prenom;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();


        $info = \App\Users::with('role', 'ville')->where('statut', '=', 'Archivé')->where('id', '=', $users->id)->get();
        $message = "suppression effectué avec succès";
        if($request->ajax()){
            return response()->json([
                'id'        => $users->id,
                'message'   => $message,
                'info'     => $info
            ]);
        }
        Session::flash('message', $message);


        return redirect()->route('users');
    }


    /**
     * @param $users
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function actif($users, Request $request){
        $users->statut = 1;
        $users->update();


        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $users->id;
        $noti->title = 'Un utilisateur à été rendu actif, '.substr($request->nom, 0, 1).' '.$request->prenom;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();


        $info = \App\Users::with('role', 'ville')->where('statut', '=', 'Actif')->where('id', '=', $users->id)->get();
        $message = "Element visible à présent";
        if($request->ajax()){
            return response()->json([
                'id'        => $users->id,
                'message'   => $message,
                'info'     => $info
            ]);
        }
        Session::flash('message', $message);


        return redirect()->route('users');
    }


}
