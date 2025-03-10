<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CommentController extends AbstractController{
    #[Route('/comment', name: 'comment')]
    public function index(): Response
    {

        return $this->render('comment/comment.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }
}
