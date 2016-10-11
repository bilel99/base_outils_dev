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
    public static function send(){
        $allusers = \App\Users::get();
        foreach($allusers as $key => $row){
            $email = $row->email;
            if(Input::get('sujet') == 'anniversaire'){
                // Si date now === date de naissance utilisateurs alors envoie mail anniversaire
                $date_now = date('m-d');
                $dateDeNaissance = substr($row->date_naissance, 5);

                if($date_now === $dateDeNaissance){
                    // Envoie du mail
                    Mail::send('mail.emails', ['sujet' => 'Anniversaire', 'objet' => 'Anniversaire', 'exp' => 'Anniversaire', 'message' => 'Anniversaire'], function($message) use ($email){
                        $message->to($email, '')->subject(Lang::get('general.suscribe_mail_title'));
                    });

                    $notificationFunction = new EnvoieMailsController();
                    $notificationFunction->historyMails(1, 'mails personnalisé', 'Anniversaire', 'Anniversaire', 'Anniversaire', 'Anniversaire', 'Anniversaire');
                    $notificationFunction->historyNotifications(Auth::user()->id, null, 'Envoie mail avec success '.'mail personnalisé', null, 1);

                    return redirect('envoieMails')->withFlashMessage("Envoie du mail personnalisé avec succès !");
                }
            }
        }

        $allNewsletter = \App\Newsletters::get();
        foreach($allNewsletter as $key => $row){
            $email = $row->email;

            if(Input::get('sujet') == 'newsletters'){
                // Si inscris à la newsletter alors envoie mails de newsletters

                // Envoie du mail
                Mail::send('mail.emails', ['sujet' => 'newsletters', 'objet' => 'newsletters', 'exp' => 'newsletters', 'message' => 'newsletters'], function($message) use ($email){
                    $message->to($email, '')->subject(Lang::get('general.suscribe_mail_title'));
                });

                $notificationFunction = new EnvoieMailsController();
                $notificationFunction->historyMails(1, 'mails personnalisé', 'newsletters', 'newsletters', 'newsletters', 'newsletters', 'newsletters');
                $notificationFunction->historyNotifications(Auth::user()->id, null, 'Envoie mail avec success '.'mail personnalisé', null, 1);

                return redirect('envoieMails')->withFlashMessage("Envoie du mail personnalisé avec succès !");
            }
        }

        return redirect('envoieMails');
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
            $notificationFunction->historyNotifications(Auth::user()->id, null, 'Envoie mail avec success '.Input::get('title'), null, 1);

        }

        return redirect('envoieMails')->withFlashMessage("Envoie du mail global efféctué avec succès !");
    }
}
