<?php
	namespace AppController;
	
	
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	
	class HelloController
	{
		public function hello()
		{
			return new Response(
				'<html lang="en"><body>Lucky number: </body></html>'
			);
		}
		
		/**
		 * @Route("/helloworld/{slug}", name="helloworld")
		 */
		public function helloWorld(string $slug): Response
		{
	
			return new Response(
				'<html lang="en"><body>Hello ' . $slug . '</body></html>'
			);
		}
	}