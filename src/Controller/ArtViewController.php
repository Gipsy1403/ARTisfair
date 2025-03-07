<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArtViewController extends AbstractController{
    #[Route('/art/view', name: 'art_view')]
    public function index(): Response
    {
        return $this->render('art_view/artview.html.twig', [
            'controller_name' => 'ArtViewController',
        ]);
    }
}
