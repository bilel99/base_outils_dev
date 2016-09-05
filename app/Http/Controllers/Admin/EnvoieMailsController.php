<?php

namespace App\Http\Controllers\Admin;

use Ficelle;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Mail;

class EnvoieMailsController extends Controller
{
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

        $ficelle = new Ficelle();

        foreach($users as $key=>$row){
            $mail = $row->email;
            //$email[] = $ficelle->trimQuote($row->email);
            //$listEmail[] = implode(',', $email);
        }

        //var_dump($listEmail);
        //dd('pause');
        // Envoie du mail
        Mail::send('mail.emails', ['sujet' => \Input::get('sujet'), 'objet' => \Input::get('objet'), 'exp' => \Input::get('exp'), 'message' => \Input::get('message')], function($message) use ($mail){
            $message->to($mail, '')->subject(Lang::get('general.suscribe_mail_title'));
        });


        // Alimentation de la table emailHistory
        $mailHistorique = new \App\MailsHistorique;
        $mailHistorique->id_langues = 1;
        $mailHistorique->type = 'mails global';
        $mailHistorique->nom = \Input::get('exp');
        $mailHistorique->exp_email = \Input::get('exp');
        $mailHistorique->exp_nom = \Input::get('exp');
        $mailHistorique->sujet = \Input::get('sujet');
        $mailHistorique->contenue = \Input::get('message');
        $mailHistorique->save();


        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = Auth::user()->id;
        $noti->id_notif;
        $noti->title = 'un mail global à été envoyé par, '.\Input::get('exp');
        $noti->description = '';
        $noti->status = 1;
        $noti->save();

        return redirect('envoieMails')->withFlashMessage("Envoie du mail global efféctué avec succès !");
    }
}
