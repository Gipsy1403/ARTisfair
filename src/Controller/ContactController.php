<?php

// namespace App\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Attribute\Route;

// final class ContactController extends AbstractController{
//     #[Route('/contact', name: 'app_contact')]
//     public function index(): Response
//     {
//         return $this->render('contact/index.html.twig', [
//             'controller_name' => 'ContactController',
//         ]);
//     }
// }


namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


final class ContactController extends AbstractController{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
	$form = $this->createForm(ContactType::class);
	$form->handleRequest($request);

	if($form->isSubmitted()&&$form->isValid()){
		$data=$form->getData();
		$email=(new Email())
		->from("artisfair@orange.fr")
		->to("artisfair@orange.fr")
		->subject("Nouveau message de contact")
		->text(
			"nom: {$data["name"]}\n".
			"Email: {$data["email"]}\n\n".
			"Message: {$data["message"]}"

		);
		$mailer->send($email);
	}
        return $this->render('contact/contact.html.twig', [
		  'contactform' => $form->createView(), //envoie du formulaire en VUE
        ]);
    }
}