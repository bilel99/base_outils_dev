<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Traits\NotifyFunctions;
use App\Http\Requests\Gestion_passwordRequest;
use App\Users;
use App\Http\Requests\UsersRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class MailsHistoriqueController extends Controller
{
    use NotifyFunctions;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /* Recherche */
        $mailsHistorique = \App\MailsHistorique::with('langues')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $mailsHistorique->setPath('mailsHistorique');


        $message = 'Aucun élément !';
        $info = \App\MailsHistorique::with('langues')->orderBy('created_at', 'desc')->get();
        if ($request->ajax()) {
            return response()->json([
                'info' => $info,
                'message' => $message
            ]);
        }

        return view('admin.mailsHistorique.index', compact('mailsHistorique'))->render();
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($mailsHistorique)
    {
        return view('admin.mailsHistorique.index', compact('mailsHistorique'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($mailsHistorique, Request $request)
    {
        $mailsHistorique->delete();

        // Alimentation de la table notificationHistory
        $notificationFunction = new MailsController();
        $notificationFunction->historyNotifications(Auth::user()->id, $mailsHistorique->id, 'Un historique de mail à été supprimé, ' . $request->nom, null, 1);

        $message = "suppression effectué avec succès";
        if ($request->ajax()) {
            return response()->json([
                'id' => $mailsHistorique->id,
                'message' => $message
            ]);
        }
        Session::flash('message', $message);


        return redirect()->route('mailsHistorique');
    }


    /**
     * @param Request $request
     */
    public function deleteAll(Request $request){
        $mailsHistorique = \App\MailsHistorique::get();
        foreach($mailsHistorique as $n){
            $n->delete();
        }

        // Alimentation de la table notificationHistory
        $notificationFunction = new MailsController();
        $notificationFunction->historyNotifications(Auth::user()->id, null, 'Un historique de mail à été supprimé ', null, 1);

        $message = "suppression effectué avec succès";
        if($request->ajax()){
            return response()->json([
                'message'   => $message
            ]);
        }
        Session::flash('message', $message);

        return redirect()->route('mailsHistorique');
    }


}
