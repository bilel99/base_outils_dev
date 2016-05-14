<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LanguesRequest;
use Dates;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NewslettersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $newsletters = \App\Newsletters::paginate(12);
        $newsletters->setPath('newsletters');

        $message = "Aucun élément présent actuellement !";
        $info = \App\Newsletters::get();
        if($request->ajax()){
            return response()->json([
                'info'     => $info,
                'message' => $message
            ]);
        }


        return view('admin/newsletters.index', compact('newsletters'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request){

        /* Recherche */
        $newsletters = \App\Newsletters::paginate(12);
        $newsletters->setPath('newsletters');

        $message = "Aucun élément présent actuellement !";
        $info = \App\Newsletters::get();
        if($request->ajax()){
            return response()->json([
                'info'     => $info,
                'message' => $message
            ]);
        }

        return view('admin.newsletters.index', compact('newsletters'))->render();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($newsletters, Request $request)
    {
        $newsletters->delete();

        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif = $newsletters->id;
        $noti->title = 'Une newsletter à été supprimé, '.$request->email;
        $noti->description = '';
        $noti->status = 1;
        $noti->save();


        $message = "suppression effectué avec succès";
        if($request->ajax()){
            return response()->json([
                'id'        => $newsletters->id,
                'message'   => $message
            ]);
        }
        Session::flash('message', $message);


        return redirect()->route('newsletters');
    }


}
