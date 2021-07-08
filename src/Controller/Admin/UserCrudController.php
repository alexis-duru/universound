<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            // TextEditorField::new('password'),
            TextField::new('username'),
            TextField::new('email'),
            ImageField::new('media', 'Profil Picture')->setBasePath('/images/media/')
                ->OnlyOnIndex(),
            TextField::new('mediaFile')->setFormType(VichImageType::class)
                ->HideOnIndex(),
        ];
    }
}
