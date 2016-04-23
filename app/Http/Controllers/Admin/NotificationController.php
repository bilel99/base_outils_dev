<?php

namespace App\Http\Controllers\Admin;

use App\Actu;
use App\Http\Requests\ActuRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $notif = \App\NotificationHistory::with('users')->where('status', '=', 1)->orderBy('id', 'desc')->paginate(8);
        $notif->setPath('notifications');

        return view('admin.notification.index', compact('notif'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($notification)
    {
    }


    public function deleteAll(){

        $noti = \App\NotificationHistory::where('status', '=', '1')->get();
        foreach($noti as $n){
            $n->status = 0;
            $n->save();
        }
        return redirect('notifications')->withFlashMessage("Suppression des notifications éffectué avec succès");
    }
}
