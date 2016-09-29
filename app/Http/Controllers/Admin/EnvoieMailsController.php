<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Traits\NotifyFunctions;
use Ficelle;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Input;
use Mail;

class EnvoieMailsController extends Controller
{
    use NotifyFunctions;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.envoieMails.index');
    }


    /**
     * @param $users
     */
    public function send($users){

    }


    /**
     * All send mail users
     */
    public function all(){

        // Récupération de toutes les adresse email de la base users role utilisateurs
        $users = \App\Users::get();

        foreach($users as $key=>$row){
            $mail = $row->email;

            // Envoie du mail
            Mail::send('mail.emails', ['sujet' => Input::get('sujet'), 'objet' => Input::get('objet'), 'exp' => Input::get('exp'), 'message' => Input::get('message')], function($message) use ($mail){
                $message->to($mail, '')->subject(Lang::get('general.suscribe_mail_title'));
            });

            $notificationFunction = new EnvoieMailsController();
            $notificationFunction->historyMails(1, 'mails global', Input::get('exp'), Input::get('exp'), Input::get('exp'), Input::get('sujet'), Input::get('message'));
            $notificationFunction->historyNotifications(Auth::user()->id, null, Input::get('title'), null, 1);

        }

        return redirect('envoieMails')->withFlashMessage("Envoie du mail global efféctué avec succès !");
    }
}
