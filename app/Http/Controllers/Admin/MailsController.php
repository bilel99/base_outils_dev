<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Gestion_passwordRequest;
use App\Http\Requests\MailsRequest;
use App\Users;
use App\Http\Requests\UsersRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class MailsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /* Recherche */
        $mails = \App\Mails::with('langues')
            ->where('nom', 'like', '%'.$request->search.'%')
            ->orWhere('type', 'like', '%'.$request->search.'%')
            ->orWhere('sujet', 'like', '%'.$request->search.'%')
            ->orWhere('id', 'like', '%'.$request->search.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $mails->setPath('mails');


        $info = \App\Mails::with('langues')->orderBy('created_at', 'desc')->get();
        if($request->ajax()){
            return response()->json([
                'info'     => $info
            ]);
        }

        return view('admin.mails.index', compact('mails'))->render();
    }


    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request){

        /* Recherche */
        $mails = \App\Mails::with('langues')
            ->where('nom', 'like', '%'.$request->search.'%')
            ->orWhere('type', 'like', '%'.$request->search.'%')
            ->orWhere('sujet', 'like', '%'.$request->search.'%')
            ->orWhere('id', 'like', '%'.$request->search.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $mails->setPath('mails');


        $info = \App\Mails::with('langues')->orderBy('created_at', 'desc')->get();

        // Recherche en AJAX
        if($request->ajax()){
            return response()->json([
                'search_mails'  => $mails,
                'info'     => $info
            ]);
        }
        // FIN


        return view('admin.mails.index', compact('mails'))->render();
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // Récuperer list select
        $langues = \App\Langues::lists('libelle', 'id');

        return view('admin.mails.create', compact('langues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(MailsRequest $request)
    {
        $mails = new \App\Mails;

        $mails->id_langues = $request->id_langues;
        $mails->type = $request->type;
        $mails->nom = $request->nom;
        $mails->exp_nom = $request->exp_nom;
        $mails->exp_email = $request->exp_email;
        $mails->sujet = $request->sujet;
        $mails->contenue = $request->contenue;
        $mails->statut = 1;

        $mails->save();

        // Récupération de l'insertion précedente
        //$last_users = \App\Users::orderBy('id', 'desc')->limit(1)->get();
        $last = $mails->id;

        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $last;
        $noti->title = 'Un mail à été créer, '.$request->nom;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();


        return redirect('mails')->withFlashMessage("Création effectué avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($mails)
    {
        return view('admin.mails.index', compact('mails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($mails)
    {
        // Récuperer list select
        $langues = \App\Langues::lists('libelle', 'id');

        return view('admin.mails.edit', compact('mails', 'langues'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($mails, MailsRequest $request)
    {
        $mails->id_langues = $request->id_langues;
        $mails->type = $request->type;
        $mails->nom = $request->nom;
        $mails->exp_nom = $request->exp_nom;
        $mails->exp_email = $request->exp_email;
        $mails->sujet = $request->sujet;
        $mails->contenue = $request->contenue;
        $mails->save();


        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $mails->id;
        $noti->title = 'Un mail à été modifié, '.$request->nom;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();


        return redirect('mails')->withFlashMessage("Mise à jours effectué avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($mails, Request $request)
    {
        $mails->statut = 2;
        $mails->update();


        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $mails->id;
        $noti->title = 'Un mail à été rendu inactif, '.$request->nom;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();


        $info = \App\Mails::with('langues')->where('statut', '=', 'inactif')->where('id', '=', $mails->id)->get();
        $message = "suppression effectué avec succès";
        if($request->ajax()){
            return response()->json([
                'id'        => $mails->id,
                'message'   => $message,
                'info'     => $info
            ]);
        }
        Session::flash('message', $message);


        return redirect()->route('mails');
    }


    /**
     * @param $users
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function actif($mails, Request $request){
        $mails->statut = 1;
        $mails->update();


        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $mails->id;
        $noti->title = 'Un mail à été rendu actif, '.$request->nom;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();


        $info = \App\Mails::with('langues')->where('statut', '=', 'Actif')->where('id', '=', $mails->id)->get();
        $message = "Element visible à présent";
        if($request->ajax()){
            return response()->json([
                'id'        => $mails->id,
                'message'   => $message,
                'info'     => $info
            ]);
        }
        Session::flash('message', $message);


        return redirect()->route('mails');
    }





}
