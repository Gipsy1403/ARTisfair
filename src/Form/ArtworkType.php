<?php

namespace App\Form;

use App\Entity\Artwork;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ArtworkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('imageName')
            ->add('updatedAt', null, [
                'widget' => 'single_text'
            ])
		  ->add('imageFile', FileType::class,[ //Champ de fichier
			"mapped"=>True,
			"required"=>False,
			"label"=>"Image",
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
			"label"=>"Image2",
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
			"label"=>"Image3",
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artwork::class,
        ]);
    }
}
