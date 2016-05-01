<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LanguesRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LanguesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $langue = \App\Langues::paginate(12);
        $langue->setPath('langues');

        $info = \App\Langues::get();
        if($request->ajax()){
            return response()->json([
                'info'     => $info
            ]);
        }


        return view('admin/langues.index', compact('langue'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request){

        /* Recherche */
        $langue = \App\Langues::paginate(12);
        $langue->setPath('langues');

        $info = \App\Langues::get();
        if($request->ajax()){
            return response()->json([
                'info'     => $info
            ]);
        }

        return view('admin.langues.index', compact('langue'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.langues.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguesRequest $request)
    {
        $langue = new \App\Langues;

        $langue->code = $request->code;
        $langue->libelle = $request->libelle;
        $langue->save();

        // Récupération de l'insertion précedente
        //$last_users = \App\Users::orderBy('id', 'desc')->limit(1)->get();
        $last_users = $langue->id;

        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $last_users;
        $noti->title = 'Une langues à été créer, '.$request->libelle;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();


        return redirect('langues')->withFlashMessage("Création effectué avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($langues)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($langues)
    {
        return view('admin.langues.edit', compact('langues'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LanguesRequest $request, $langues)
    {
        $langues->code = $request->code;
        $langues->libelle = $request->libelle;
        $langues->save();

        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $langues->id;
        $noti->title = 'Une langue à été modifié, '.$request->libelle;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();


        return redirect('langues')->withFlashMessage("Mise à jours effectué avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($langues, Request $request)
    {
        $langues->delete();

        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $langues->id;
        $noti->title = 'Une langues à été supprimé, '.$request->libelle;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();


        $message = "suppression effectué avec succès";
        if($request->ajax()){
            return response()->json([
                'id'        => $langues->id,
                'message'   => $message
            ]);
        }
        Session::flash('message', $message);


        return redirect()->route('langues');
    }
}
