<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\AuthentificationRequest;
use App\Http\Requests\EmailPasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;

class RootController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function index(){

    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function login(AuthentificationRequest $request)
    {
        //On recupère les données postés par le formulaire
        $email      = $request->email;
        $password   = $request->password.\Config::get('constante.salt');
        $remember   = $request->remember;

        // Si l'email et le mot de passe saisis sont correctes
        // Sinon on redirige vers la page d'authentification avec message d'erreur
        if (\Auth::attempt(['email' => $email, 'password' => $password], $remember)) {

            //Mise à jour la derniere connexion en bdd
            $user = new \App\Users();
            $user = \App\Users::find(\Auth::user()->id);
            $user->derniere_connexion = date('Y-m-d H:i:s');
            $user->save();

            if (\Auth::user()->id_roles_users==1) {
                return redirect('/digitheque');
            }elseif(\Auth::user()->id_roles_users==2){
                return redirect('/administration');
            }
        }else{
            return redirect('/')->withFlashMessageError(Lang::get('global.erreurAuth'));
        }
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register(Request $request){
        // AJAX GET ACTU
        $actu = \App\Actu::with('langues', 'users')->where('status', '=', 1)->orderBy(DB::raw('RAND()'))->take(1)->get();
        if($request->ajax()){
            return response()->json([
                'actu'  =>  $actu
            ]);
        }

        return view('auth.register', compact('actu'));
    }








    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(RegisterRequest $request)
    {
        // Enregistrement d'un Utilisateurs
        $users = new \App\Users();

        // Ajout de l'avatar par default
        $users->avatar = '/img/users/default.jpg';

        $users->nom = $request->nom;
        $users->prenom = $request->prenom;
        $users->email = $request->email;
        $users->id_roles_users = $request->id_roles_users;

        $users->statut = 1;

        if($request->password == $request->conf_password){
            $users->password = \Hash::make($request->password.\Config::get('constante.salt'));
        }else{
            return redirect('/register')->withFlashMessageError(Lang::get('general.error_password'));
        }

        $users->save();

        // envoie du mail
        Mail::send('mail.register', compact('users'), function($message) use ($users){

            $message->to($users['email'], '')->subject(Lang::get('general.suscribe_mail_title'));
        });

        return redirect('/')->withFlashMessage(Lang::get('general.success_register'));
    }


    /**
     * @return \Illuminate\View\View
     * Disconnect (logout)
     */
    public function logout(){
        Auth::logout();
        return redirect('/')->withFlashMessage(Lang::get('general.d'));
    }





    public function getEmail()
    {
        return view('auth.password');
    }

    public function postEmail(EmailPasswordRequest $request)
    {
        $email = $request->email;

        // Création d'un mot de passe aléatoire
        $chaine = 'azertyuiopqsdfghjklmwxcvbn123456789';
        $nb_car = 10;
        $nb_lettres = strlen($chaine) - 1;
        $generation = '';
        for($i=0; $i < $nb_car; $i++)
        {
            $pos = mt_rand(0, $nb_lettres);
            $car = $chaine[$pos];
            $generation .= $car;
        }

        // Vérification que le mail existe en base de données
        $user = new \App\Users();
        $user = \App\Users::where('email', '=', $email)->count();

        if ($user>0) {
            // Insertion du mot de passe provisoire en base de données
            $id_user = \App\Users::where('email', '=', $request->email)->get();
            $id = $id_user[0]->id;

            $user=\App\Users::find($id);
            $user->forgotPass = $generation;
            $user->save();

            // Envoie du mail
            Mail::send('mail.password', compact('generation'), function($message) use($request){
                $message->to($request->email, '')->subject(Lang::get('general.suscribe_mail_title'));
            });
            return redirect()->back()->withFlashMessage(Lang::get('global.successEMailPassword'));
        }else{
            return redirect('/')->withFlashMessageError(Lang::get('global.erreurEMailPassword'));
        }
    }

    public function getReset()
    {
        return view('auth.reset');
    }

    public function postReset(ResetPasswordRequest $request)
    {
        $email            = $request->email;
        $old_password     = $request->old_password;
        $password         = $request->password;
        $password_confirm = $request->password_confirm;

        // Vérification que le couple mail/old_password est valide
        $user = new \App\Users();
        $user = \App\Users::where('email', '=', $email)->where('forgotPass','=', $old_password)->count();
        if ($user>0) {
            // Mise à jour du mot de passe
            if ($password === $password_confirm){
                // Mise à jour du mot de passe en base de données
                $id_user = \App\Users::where('email', '=', $email)->get();
                $id = $id_user[0]->id;

                $user=\App\Users::find($id);
                $user->password = \Hash::make($request->password.\Config::get('constante.salt'));
                $user->save();
                //redirection sur la page d'authentification
                return redirect('/')->withFlashMessageError(Lang::get('global.successNewConfirmPassword'));
            }else{
                //redirection avec message d'erreur
                return redirect('password/reset')->withFlashMessageError(Lang::get('global.errorConfirmPassword'));
            }
        }else{
            //redirection avec message d'erreur
            return redirect('password/reset')->withFlashMessageError(Lang::get('global.erreurEMailOldPassword'));
        }


        // Mise à jour du nouveau mot de passe

    }



    /**
     * @return \Illuminate\Http\RedirectResponse
     * return Lang
     */
    public function language(){
        session()->set('locale', session('locale') == 'fr' ? 'en' : 'fr');

        return redirect()->back();
    }

}
