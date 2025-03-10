<?php

namespace App\Controller;

use App\Repository\ArtworkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArtistController extends AbstractController{
    #[Route('/artist', name: 'artist')]
    public function index(Request $request, ArtworkRepository $repository): Response
    {
	     // Récupère l'utilisateur connecté
		$user = $this->getUser();
		// vérifie que l'utilisateur soit bien connecté
		if (!$user) {
	    		throw $this->createAccessDeniedException('Veuillez vous authentifier en vous connectant.');
		}
		$artwork = $repository->findBy(['user' => $user]);

        return $this->render('artist/monespace.html.twig', [
            'artworks' => $artwork,
        ]);
    }
}
