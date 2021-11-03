<?php
	
	namespace App\DataFixtures;
	
	use App\Entity\Task;
	use DateTime;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\Persistence\ObjectManager;
	use Exception;
	
	class TaskFixtures extends Fixture
	{
		
		/**
		 * @inheritDoc
		 * @throws Exception
		 */
		public function load(ObjectManager $manager)
		{
			// TODO: Implement load() method.
			for ($count = 0; $count < 100; $count++) {
				$task = new Task();
				$task->setTitle('Titre ' . $count);
				$task->setTdate(new DateTime('now'));
				$task->setStatus(random_int(0,1) ===1);
				$manager->persist($task);
			}
			$manager->flush();
		}
	}