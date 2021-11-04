<?php

namespace App\Controller\Admin;

use App\Entity\Task;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
	   /* $repository = $this->getDoctrine()->getRepository(Task::class);
	    return new Response(
		    '<html lang="en"><body>Lucky number:'' </body></html>'
	    );
	
	    return $repository->findAll();*/
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Symfonist');
    }

    public function configureMenuItems(): iterable
    {
	    yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
	    yield MenuItem::linkToCrud('Task', 'fa fa-file-alt', Task::class);
	    yield MenuItem::linkToCrud('User', 'fa fa-users', User::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
