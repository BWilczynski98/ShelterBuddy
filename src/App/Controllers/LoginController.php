<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\View;

class LoginController
{
    public function index(): void
    {
        View::render('login.html.twig');
    }
}