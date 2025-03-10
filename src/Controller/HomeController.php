<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController{
    #[Route('/', name: 'home')]
    public function index(CommentRepository $repository): Response
    {
		$comment=$repository->findBy([],["id"=>"DESC"],4);
        return $this->render('home/index.html.twig', [
            'comments' => $comment,
        ]);
    }
}
