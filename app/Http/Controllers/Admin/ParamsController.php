<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Traits\NotifyFunctions;
use App\Http\Requests\ParamsRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ParamsController extends Controller
{
    use NotifyFunctions;

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

        // Vérifier si code existe en bdd
        $countCode = \App\Params::where('code',$request->code)->count();
        if($countCode != 0){
            return redirect('params/create')->withFlashMessageError("Erreur code existant en base de donnée !");
        }else{
            $params->code = $request->code;
            $params->libelle = $request->libelle;
            $params->status = 1;
            $params->save();
        }


        // Alimentation de la table notificationHistory
        $notificationFunction = new ParamsController();
        $notificationFunction->historyNotifications(Auth::user()->id, $params->id, 'Un paramètre à été créer, '.$request->libelle, null, 1);

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
    public function edit($params)
    {
        // Edition form
        $langues = \App\Langues::lists('libelle', 'id');

        return view('admin.params.edit', compact('params', 'langues'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParamsRequest $request, $params)
    {
        // Edition of database
        $params->id_langues = $request->id_langues;
        $params->code = $request->code;
        $params->libelle = $request->libelle;
        $params->save();

        // Alimentation de la table notificationHistory
        $notificationFunction = new ParamsController();
        $notificationFunction->historyNotifications(Auth::user()->id, $params->id, 'Un paramètre à été modifier, '.$request->libelle, null, 1);

        return redirect('params')->withFlashMessage("Mise à jours effectué avec succès");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del($params, Request $request){
        // Alimentation de la table notificationHistory
        $notificationFunction = new ParamsController();
        $notificationFunction->historyNotifications(Auth::user()->id, $params->id, 'paramètre supprimé, '.$params->id, null, 1);

        // Suppression de paramètre
        $params->delete();

        $message = 'élément supprimer !';
        if($request->ajax()){
            return response()->json([
                'message' => $message
            ]);
        }

        return redirect()->route('params');
    }



    /**
     * @param $params
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function statusOff($params, Request $request){
        $params->status = 0;
        $params->save();

        // Alimentation de la table notificationHistory
        $notificationFunction = new ParamsController();
        $notificationFunction->historyNotifications(Auth::user()->id, $params->id, 'status paramètre à été rendu innactif, '.$params->code, null, 1);

        $info = \App\Params::where('id', '=', $params->id)->get();
        if($request->ajax()){
            return response()->json([
                'id'        => $params->id,
                'info'      => $info,
            ]);
        }

        return redirect()->route('params');

    }


    /**
     * @param $params
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function statusOn($params, Request $request){
        $params->status = 1;
        $params->save();

        // Alimentation de la table notificationHistory
        $notificationFunction = new ParamsController();
        $notificationFunction->historyNotifications(Auth::user()->id, $params->id, 'status paramètre à été rendu actif, '.$params->code, null, 1);

        $info = \App\Params::where('id', '=', $params->id)->get();
        if($request->ajax()){
            return response()->json([
                'id'        => $params->id,
                'info'     => $info
            ]);
        }

        return redirect()->route('params');

    }

}
