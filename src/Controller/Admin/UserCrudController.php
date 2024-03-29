<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
	
	public function configureFilters(Filters $filters): Filters
	{
		return $filters
			->add('username')->add('mail');
	}
	
	public function configureCrud(Crud $crud): Crud
	{
		return $crud
			->setEntityLabelInSingular('User')
			->setEntityLabelInPlural('Users')
			->setSearchFields(['username', 'mail']);
	}
}
