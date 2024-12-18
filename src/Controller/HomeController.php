<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): RedirectResponse
    {
        if ($this->getUser()) {
            // if logged in, redirect to dashboard
            return $this->redirectToRoute('dashboard');
        } else {
            // if not logged in, redirect to login
            return $this->redirectToRoute('app_login');
        }
    }
}