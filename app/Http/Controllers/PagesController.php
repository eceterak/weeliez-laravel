<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    /**
     * Display index.
     * 
     * @return view
     */
    public function index() 
    {
        return view('pages.index');
    }
}
