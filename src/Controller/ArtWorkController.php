<?php

namespace App\Controller;

use App\Entity\Artwork;
use App\Form\ArtworkType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
final class ArtWorkController extends AbstractController{
    #[Route('/artwork/{id}', name: 'modify_artwork')]
    #[Route('/artwork', name: 'add_artwork')]
    public function index(Artwork $artwork = null,Request $request, EntityManagerInterface $entityManager): Response
    {
		// Récupère l'utilisateur connecté
		$user = $this->getUser();

	    // Si l'oeuvre n'existe pas, alors la création se fait
	    if(!$artwork){
		   $artwork = new Artwork();
	    }
	    // Récupération du formulaire et association avec l'objet
	    $form = $this->createForm(ArtworkType::class,$artwork);
	
	    // Récupération des données POST du formulaire
	    $form->handleRequest($request);
	    // Vérification si le formulaire est soumis et Valide
	    if($form->isSubmitted() && $form->isValid()){
		$artwork->setUser($this->getUser("id"));

		// Bloc permettant de remplir les emplacements vides avec un image que l'artiste a déjà déposé s'il n'en dépose pas 3
		$images = array_filter([
			$artwork->getImageName(),
			$artwork->getImage2Name(),
			$artwork->getImage3Name()
		 ]);
   
		 if (!empty($images)) {
			while (count($images) < 3) {
			    $images[] = $images[array_rand($images)];
			}
			// Appliquer les valeurs mises à jour
			$artwork->setImageName($images[0]);
			$artwork->setImage2Name($images[1]);
			$artwork->setImage3Name($images[2]);
		 }
		//  fin du bloc pour les images

		   // Persistance des données
		   $entityManager->persist($artwork);
		   // Envoi en BDD
		   $entityManager->flush();
	
		   // Redirection de l'utilisateur
		   return $this->redirectToRoute('artist');
	    }
        return $this->render('artwork/addupdate.html.twig', [
            'artworkform' => $form->createView(), //envoie du formulaire en VUE
		  "artworks"=>$artwork,
            'isModification' => $artwork->getId() !== null //Envoie d'un variable pour définir si on est en Modif ou Créa
        ]);
    }

    #[Route('/artwork/remove/{id}', name: 'delete_artwork')]
    public function remove(Artwork $artwork, Request $request, EntityManagerInterface $entityManager): Response
    {
         if($this->isCsrfTokenValid('SUP'.$artwork->getId(),$request->get('_token'))){
            $entityManager->remove($artwork);
            $entityManager->flush();
            $this->addFlash('success','La suppression à été effectuée');
            return $this->redirectToRoute('artist');

        }
    }
}

