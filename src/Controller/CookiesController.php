<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CookiesController extends AbstractController{
    #[Route('/cookies', name: 'cookies_policy')]
    public function index(): Response
    {
        return $this->render('cookies/policy.html.twig', [
            'controller_name' => 'CookiesController',
        ]);
    }
}
