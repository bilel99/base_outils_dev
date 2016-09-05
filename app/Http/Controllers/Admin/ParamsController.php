<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ParamsRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ParamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Listes des paramètres avec Actions
        $params = \App\Params::with('langue')->orderBy('id', 'desc')->paginate(8);
        $params->setPath('params');


        $message = "Aucun élément présent actuellement !";
        $paramsAjax = \App\Params::with('langue')->get();
        if($request->ajax()){
            return response()->json([
                'info'      =>  $paramsAjax,
                'message'   =>  $message
            ]);
        }


        return view('admin.params.index', compact('params'));
    }



    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request){
        /* Recherche */
        $params = \App\Params::with('langue')->where('status', '=', 1)->orderBy('id', 'desc')->paginate(8);
        $params->setPath('params');


        $message = "Aucun élément présent actuellement !";
        $paramsAjax = \App\Params::with('langue')->get();
        if($request->ajax()){
            return response()->json([
                'info'      =>  $paramsAjax,
                'message'   =>  $message
            ]);
        }


        return view('admin.params.index', compact('params'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Create form
        $langues = \App\Langues::lists('libelle', 'id');

        return view('admin.params.create', compact('langues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParamsRequest $request)
    {
        // Create of database
        $params = new \App\Params;
        $params->id_langues = $request->id_langues;
        $params->code = $request->code;
        $params->libelle = $request->libelle;
        $params->status = 1;
        $params->save();

        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $params->id;
        $noti->title = 'Un paramètre à été créer, '.$request->libelle;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();

        return redirect('params')->withFlashMessage("Création effectué avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Visualisation de paramètres en détails
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Edition form
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
        // Edition of database
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Suppression de paramètre
    }
}
