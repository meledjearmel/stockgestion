<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessagerieController extends Controller
{
    public function index ()
    {
        $emailView = true;
        return view('messagerie.home', compact('emailView'));
    }


}
