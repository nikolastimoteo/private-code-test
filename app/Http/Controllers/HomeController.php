<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Get the home page.
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return View
     */
    public function getHome()
    {
        return view('home');
    }
}
