<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use Core\CMS;
use Core\View;

class UserController
{
    protected CMS $cms;

    public function __construct(CMS $cms)
    {
        $this->cms = $cms;
    }

    public function listUsers(): void
    {
       $user_model = $this->cms->getModel(User::class);
       $users = $user_model->getAll();

       View::render('/users/users.twig', ['users' => $users]);
    }

    public function getById(int $id): void
    {
        $user = $this->cms->getModel(User::class)->getById($id);
        View::render('/users/profile.twig', ['user' => $user]);
    }
}