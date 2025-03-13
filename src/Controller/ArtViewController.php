<?php

namespace App\Controller;


use App\Entity\Artwork;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\ArtworkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ArtViewController extends AbstractController{
    #[Route('/art/view/{id}', name: 'artview')]
//     public function index(ArtworkRepository $repository,$id): Response
//     {
// 		$artwork=$repository->find($id);
//         return $this->render('art_view/artview.html.twig', [
//             'artworks' => $artwork,
//         ]);
//     }
public function artview(Artwork $Artwork,Request $request, EntityManagerInterface $entityManager): Response
    {
	$comment=new Comment();
	$form = $this->createForm(CommentType::class,$comment);
	$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
		$comment->setUser($this->getUser()); // L'utilisateur connecté
		$comment->setArtwork($Artwork);
		$comment->setDate(new \DateTimeImmutable());	
		$entityManager->persist($comment);
		$entityManager->flush();
		return $this->redirectToRoute('view',['id' => $Artwork->getId()]);
	}
        return $this->render('view/view.html.twig', [
            'Artwork' => $Artwork,
		  'commentform' => $form->createView(), 
		]);
    }

}
