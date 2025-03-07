<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AllArtistController extends AbstractController{
    #[Route('/all/artist', name: 'all_artist')]
    public function index(): Response
    {
        return $this->render('all_artist/allartist.html.twig', [
            'controller_name' => 'AllArtistController',
        ]);
    }
}
