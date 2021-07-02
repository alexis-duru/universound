<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Track;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

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
                'allow_delete' => true,
                'delete_label' => 'Remove Photo',
                'download_uri' => true,
                'download_label' => 'Download Photo',
                'asset_helper' => true,
            ])
            ->add('audioFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Remove Audio',
                'download_uri' => true,
                'download_label' => 'Download Audio',
                'asset_helper' => true,
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
