<?php

/**
 * Created by PhpStorm.
 * User: bilel
 * Date: 29/09/2016
 * Time: 14:20
 */

namespace App\Http\Controllers\Traits;

trait NotifyFunctions
{
    /**
     * @param int $id_langue
     * @param string $type
     * @param $nom
     * @param $exp_nom
     * @param $exp_email
     * @param $sujet
     * @param $contenue
     * @return \App\MailsHistorique
     */
    public function historyMails($id_langue = 1, $type = 'mails global', $nom, $exp_nom, $exp_email, $sujet, $contenue){
        // Alimentation de la table emailHistory
        $mailHistorique = new \App\MailsHistorique;
        $mailHistorique->id_langues = $id_langue;
        $mailHistorique->type = $type;
        $mailHistorique->nom = $nom;
        $mailHistorique->exp_email = $exp_email;
        $mailHistorique->exp_nom = $exp_nom;
        $mailHistorique->sujet = $sujet;
        $mailHistorique->contenue = $contenue;
        $mailHistorique->save();

        return $mailHistorique;
    }


    /**
     * @param $id_users
     * @param null $id_notif
     * @param $title
     * @param null $description
     * @param int $status
     * @return \App\NotificationHistory
     */
    public function historyNotifications($id_users, $id_notif = null, $title, $description = null, $status = 1){
        // Alimentation de la table notificationHistory
        $noti = new \App\NotificationHistory;
        $noti->id_users = $id_users;
        $noti->id_notif = $id_notif;
        $noti->title = $title;
        $noti->description = $description;
        $noti->status = $status;
        $noti->save();

        return $noti;
    }
}