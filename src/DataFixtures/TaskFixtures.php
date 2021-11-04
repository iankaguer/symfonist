<?php
	
	namespace App\DataFixtures;
	
	use App\Entity\Task;
	use DateTime;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\Common\DataFixtures\DependentFixtureInterface;
	use Doctrine\ORM\EntityManagerInterface;
	use Doctrine\Persistence\ObjectManager;
	use Exception;
	
	class TaskFixtures extends Fixture implements DependentFixtureInterface
	{
		
		/**
		 * @inheritDoc
		 * @throws Exception
		 */
		public function load(ObjectManager $manager)
		{
			
			$user = $this->getReference('user');
			for ($count = 0; $count < 100; $count++) {
				$task = new Task();
				$task->setTitle('Titre ' . $count);
				$task->setTdate(new DateTime('now'));
				$task->setStatus(random_int(0,1) ===1);
				$task->setUserId($user);
				$manager->persist($task);
			}
			$manager->flush();
		}
		
		public function getDependencies(): array
		{
			return [
				UserFixtures::class,
			];
		}
		
		
	}