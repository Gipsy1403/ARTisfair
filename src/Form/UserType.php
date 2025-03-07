<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
		->add('name', TextType::class,[
			"label"=>"Nom"
		])
		->add('first_name',TextType::class,[
			"label"=>"Prénom"
		])
		// ->add('artist_name',TextType::class,[
		// 	"label"=>"Prénom"
		// ])
		->add('email')
		->add('password',PasswordType::class,[
			"label"=>"Mot de passe",
			'constraints' => [
				new NotBlank(['message' => 'Le mot de passe est obligatoire']),
				new Length([
					'min' => 8,
					'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères',
				]),
			],
		])
		// ->add('confirm', PasswordType::class, [
		// "label"=>"Confirmer le mot de passe : ",
		// "mapped"=>false,
		// ])
	;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
