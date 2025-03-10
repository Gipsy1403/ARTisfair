<?php

namespace App\Form;

use App\Entity\Art;
use App\Entity\Artwork;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArtworkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
		  ->add('imageFile', FileType::class,[ //Champ de fichier
			"mapped"=>True,
			"required"=>False,
			"label"=>"Image n°1",
			'constraints' => [
			    new File([
				   'maxSize' => '2M', //Ajout de contrainte (Optionnel)
				   'mimeTypes' => [
					  'image/jpeg',
					  'image/jpg',
					  'image/png',
					  'image/webp',
				   ],
				   'mimeTypesMessage' => 'Veuillez télécharger un fichier au format JPEG, JPG, PNG ou WEBP.'
			    ])
			]
		 ])
		 ->add('image2File', FileType::class,[ //Champ de fichier
			"mapped"=>True,
			"required"=>False,
			"label"=>"Image n°2",
			'constraints' => [
			    new File([
				   'maxSize' => '2M', //Ajout de contrainte (Optionnel)
				   'mimeTypes' => [
					  'image/jpeg',
					  'image/jpg',
					  'image/png',
					  'image/webp',
				   ],
				   'mimeTypesMessage' => 'Veuillez télécharger un fichier au format JPEG, JPG, PNG ou WEBP.'
			    ])
			]
		 ])
		 ->add('image3File', FileType::class,[ //Champ de fichier
			"mapped"=>True,
			"required"=>False,
			"label"=>"Image n°3",
			'constraints' => [
			    new File([
				   'maxSize' => '2M', //Ajout de contrainte (Optionnel)
				   'mimeTypes' => [
					  'image/jpeg',
					  'image/jpg',
					  'image/png',
					  'image/webp',
				   ],
				   'mimeTypesMessage' => 'Veuillez télécharger un fichier au format JPEG, JPG, PNG ou WEBP.'
			    ])
			]
		 ])
		 ->add('title', TextType::class,[
			"label"=>"Titre de l'oeuvre",
		 ])
		->add('description',TextareaType::class,[
			"label"=>"Description",
		])
		// ->add("art", EntityType::class,[
		// 	"class"=>Art::class,
		// 	"choice_label"=>"name",
		// 	"Label"=>"Art",
		// 	"mapped"=>false,
		// 	"multiple"=>false,
		// ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artwork::class,
        ]);
    }
}
