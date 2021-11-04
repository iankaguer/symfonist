<?php
	
	namespace AppController\Admin;
	
	use App\Entity\User;
	use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
	use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
	use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
	use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
	use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
	use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
	use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
	use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
	
	class UserCrudController extends AbstractCrudController
	{
		
		public static function getEntityFqcn(): string
		{
			return User::class;
		}
		
		public function configureCrud(Crud $crud): Crud
		{
			return $crud
				->setEntityLabelInSingular('User')
				->setEntityLabelInPlural('Users')
				->setSearchFields(['username', 'mail']);
		}
		
		public function configureFilters(Filters $filters): Filters
		{
			return $filters
				->add('username')->add('username');
		}
		
		public function configureFields(string $pageName): iterable
		{
			return [
				IdField::new('id'),
				TextField::new('username'),
				EmailField::new('mail'),
				Field::new('validated'),
				DateTimeField::new('created_at'),
				DateTimeField::new('last_connexion')
			];
		}
	}