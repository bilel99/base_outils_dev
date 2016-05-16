<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ClearsCacheController extends Controller
{

    /**
     *  Clears the cache of servers
     */
    public function reset(){
        clearstatcache();

        $message = "Cache Serveur vidé avec succèss";
        Session::flash('flash_message', $message);
        return redirect()->back();
    }

}
