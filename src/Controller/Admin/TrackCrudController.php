<?php

namespace App\Controller\Admin;

use App\Entity\Track;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            TextField::new('details', 'infos'),
            ImageField::new('media')->setBasePath('/images/media/')
                ->OnlyOnIndex(),
            TextField::new('mediaFile')->setFormType(VichImageType::class)
                ->HideOnIndex(),
            DateTimeField::new('createdAt'),
        ];
    }
}
