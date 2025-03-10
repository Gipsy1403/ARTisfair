<?php

namespace App\Controller;

use App\Repository\ArtworkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GalleryController extends AbstractController{
    #[Route('/gallery', name: 'gallery')]
    public function index(ArtworkRepository $repository): Response
    {
		$artwork=$repository->findAll();
        return $this->render('gallery/gallery.html.twig', [
            'artworks' => $artwork,
        ]);
    }
}
