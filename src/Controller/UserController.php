<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
	/**
	 * @Route("/login", name="login")
	 */
	public function loginAction()
	{
		return $this->render('security/login.html.twig');
	}
	
	/**
	 * @Route("/logout")
	 * @throws \RuntimeException
	 */
	public function logoutAction()
	{
		throw new \RuntimeException('This should never be called directly.');
	}
}
