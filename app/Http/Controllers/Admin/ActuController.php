<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ActuRequest;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ActuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $actu = \App\Actu::with('users', 'langues')->paginate(12);
        $actu->setPath('actu');

        $message = "Aucun élément présent actuellement !";
        $actuAjax = \App\Actu::with('langues', 'users')->get();
        if($request->ajax()){
            return response()->json([
                'info'      =>  $actuAjax,
                'message'   =>  $message
            ]);
        }

        return view('admin.actu.index', compact('actu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langues = \App\Langues::lists('libelle', 'id');
        return view('admin.actu.create', compact('langues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActuRequest $request)
    {
        $actu = new \App\Actu;
        $actu->id_langues = $request->id_langues;
        $actu->id_users = Auth::user()->id;
        $actu->libelle = $request->libelle;
        $actu->description = $request->description;

        //On ajoute l'image, si aucune alors par default
        if($request->image){
            $destinationPath = public_path() . '/img/actu/';
            $fileName = 'actu_' .strtotime('now').'.'.$request->image->getClientOriginalExtension();
            $request->image->move($destinationPath, $fileName);
            $actu['image'] = 'img/actu/' .$fileName;
        }
        else{
            $actu->image = '/img/actu/default.jpeg';
        }

        $actu->status = 1;
        $actu->save();

        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $actu->id;
        $noti->title = 'Une actualité à été créer, '.$request->libelle;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();

        return redirect('actu')->withFlashMessage("Création effectué avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($actu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($actu)
    {
        // Edition form
        $langues = \App\Langues::lists('libelle', 'id');

        return view('admin.actu.edit', compact('actu', 'langues'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActuRequest $request, $actu)
    {
        $actu->id_langues = $request->id_langues;
        $actu->libelle = $request->libelle;
        $actu->description = $request->description;

        //dd($request->image);
        //On ajoute l'image, si aucune alors par default
        if($request->image != null){
            $destinationPath = public_path() . '/img/actu/';
            $fileName = 'actu_' .strtotime('now').'.'.$request->image->getClientOriginalExtension();
            $request->image->move($destinationPath, $fileName);
            $actu['image'] = 'img/actu/' .$fileName;
        }
        else{
            $actu->image = $request->img_populate;
        }

        $actu->save();

        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $actu->id;
        $noti->title = 'Une actualité à été modifier, '.$request->libelle;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();

        return redirect('actu')->withFlashMessage("Mise à jours effectué avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del($actu, Request $request)
    {
        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $actu->id;
        $noti->title = 'Actualité supprimé, '.$actu->id;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();

        // Suppression
        $actu->delete();

        $message = 'élément supprimer !';
        if($request->ajax()){
            return response()->json([
                'message' => $message
            ]);
        }

        return redirect()->route('actu');
    }



    /**
     * @param $actu
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function statusOff($actu, Request $request){
        $actu->status = 0;
        $actu->save();

        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $actu->id;
        $noti->title = 'status actualité à été rendu innactif, '.$actu->libelle;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();

        $info = \App\Actu::where('id', '=', $actu->id)->get();
        if($request->ajax()){
            return response()->json([
                'id'        => $actu->id,
                'info'      => $info,
            ]);
        }

        return redirect()->route('actu');

    }


    /**
     * @param $actu
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function statusOn($actu, Request $request){
        $actu->status = 1;
        $actu->save();

        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $actu->id;
        $noti->title = 'status actualité à été rendu actif, '.$actu->libelle;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();

        $info = \App\Actu::where('id', '=', $actu->id)->get();
        if($request->ajax()){
            return response()->json([
                'id'        => $actu->id,
                'info'     => $info
            ]);
        }

        return redirect()->route('actu');

    }



}
