<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Track;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TrackUploadFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            // ->add('label', TextType::class, [
            //     'required' => false,
            // ])
            ->add('genre')
            ->add('details')
            ->add('mediaFile', VichFileType::class, [
                'required' => true,
                'allow_delete' => false,
                'delete_label' => '',
                'download_uri' => false,
                'download_label' => '',
                'asset_helper' => true,
                'invalid_message' => 'Please, upload a .jpeg or .png file only',
                'constraints' => [
                    new File([
                        'maxSize' => '2000k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ]
                    ])
                ]
            ])
            ->add('audioFile', VichFileType::class, [
                'required' => true,
                'allow_delete' => false,
                'invalid_message' => 'Please, upload a .mp3 or a .wav file only',
                'delete_label' => 'Remove Audio',
                'download_uri' => false,
                'download_label' => 'Download Audio',
                'asset_helper' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '60000k',
                        'mimeTypes' => [
                            'audio/mpeg',
                            'audio/x-wav',
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
