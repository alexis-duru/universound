<?php

namespace App\Controller\Admin;

use App\Entity\Track;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TrackCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Track::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            TextField::new('artist')->hideOnForm(),
            TextField::new('title', 'Track'),
            TextField::new('label'),
            TextField::new('genre'),
            TextField::new('details', 'Infos'),
            ImageField::new('media')->setBasePath('/images/media/')
            ->OnlyOnIndex(),
            TextField::new('mediaFile')
            ->setFormType(VichImageType::class)
            ->setTranslationParameters(['form.label.delete'=>'Delete'])
            ->HideOnIndex(),
            DateTimeField::new('createdAt'),
            ImageField::new('audio')->setBasePath('/audio/media/')
            ->OnlyOnIndex(),
            TextField::new('audioFile')
            ->setFormType(VichFileType::class)
            ->setTranslationParameters(['form.label.delete'=>'Delete'])
            ->HideOnIndex(),
        ];
    }
}

