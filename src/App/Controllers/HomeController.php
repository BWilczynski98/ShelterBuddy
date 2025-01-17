<?php

namespace App\Controllers;

use Core\View;

class HomeController
{
    public function index(): void
    {
        View::render('index.twig');
    }
}