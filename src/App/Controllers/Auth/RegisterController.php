<?php

namespace App\Controllers\Auth;

use App\Models\Auth\Register;
use App\Validation\Validator;
use Core\CMS;
use Core\Helpers;
use Core\View;

class RegisterController
{
    protected CMS $cms;
    public function __construct(CMS $cms)
    {
        $this->cms = $cms;
    }

    public function index(): void
    {
        View::render('auth/register.twig');
    }

    public function register(): void
    {
        $email              =   filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?? '';
        $password           =   filter_input(INPUT_POST, 'password') ?? '';
        $confirm_password   =   filter_input(INPUT_POST, 'confirm_password') ?? '';

        if (!Validator::isNotEmpty($email, $password, $confirm_password)) {
            View::render('auth/register.twig', ['error' => 'Wszystkie pola są wymagane.']);
            return;
        }

        if (!Validator::isPasswordMatch($password, $confirm_password)) {
            View::render('auth/register.twig', ['error' => 'Hasła muszą być takie same.']);
            return;
        }

        $response = $this->cms->getModel(Register::class)->create($email, $password);

        if ($response) {
            $this->redirect("/login", 303);
        } else {
            View::render('auth/register.twig', ['error' => 'Istnieje już konto o podanym adresie email.']);
        }

    }

    private function redirect(string $url, ?int $response_code = 302): void
    {
        $url = 'Location: ' . DOC_ROOT . $url;
        http_response_code($response_code);
        header($url);
        exit;
    }
}