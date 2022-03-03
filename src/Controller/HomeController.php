<?php

namespace App\Controller;

class HomeController extends BaseController
{

    public function index()
    {
        return view()->render('home/index.html.twig');
    }
}
