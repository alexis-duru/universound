<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Track;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TrackUploadFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('label')
            ->add('genre')
            // ->add('genre', ChoiceType::class, [
            //     'choices' => [
            //         new Genre('Name'),
            //         new Genre('Name'),
            //         new Genre('Name'),
            //         new Genre('Name'),
            //     ]])
            ->add('details')
            ->add('mediaFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => false,
                'delete_label' => '',
                'download_uri' => false,
                'download_label' => '',
                'asset_helper' => true,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ]
                    ])
                ]
            ])
            ->add('audioFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => false,
                'delete_label' => 'Remove Audio',
                'download_uri' => false,
                'download_label' => 'Download Audio',
                'asset_helper' => true,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'audio/mpeg',
                        ]
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Track::class,
        ]);
    }
}
