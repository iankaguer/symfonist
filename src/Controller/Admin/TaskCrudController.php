<?php

namespace App\Controller\Admin;

use App\Entity\Task;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TaskCrudController extends AbstractCrudController
{


    public static function getEntityFqcn(): string
    {
        return Task::class;
    }
	public function configureCrud(Crud $crud): Crud
     {
         return $crud
             ->setEntityLabelInSingular("Task")
             ->setEntityLabelInPlural("Tasks")
             ->setSearchFields(["title", "tdate", "status"])
	         ->setPaginatorPageSize(5)
	         ->setPaginatorRangeSize(4)
         ;
     }
 
     public function configureFilters(Filters $filters): Filters
     {
	         return $filters
		         ->add('title')->add('tdate')->add("status");
     }
    
    public function configureFields(string $pageName): iterable
    {
        return [
			IdField::new("id"),
            TextField::new("title"),
	        DateTimeField::new('tdate'),
	        Field::new('status'),
	        AssociationField::new('userId')->setLabel("User")->setColumns("username")
        ];
    }
    
}
