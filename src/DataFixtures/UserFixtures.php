<?php
	namespace App\DataFixtures;
	
	use App\Entity\User;
	use DateTimeImmutable;
	use DateTimeZone;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\DBAL\Driver\PDO\Exception;
	use Doctrine\Persistence\ObjectManager;
	use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
	use Faker;

	
	class UserFixtures extends Fixture
	{
		private UserPasswordEncoderInterface $encoder;
		
		public function __construct(UserPasswordEncoderInterface $encoder)
		{
			$this->encoder = $encoder;
		}
		
		/**
		 * @inheritDoc
		 */
		public function load(ObjectManager $manager)
		{			$faker = Faker\Factory::create('fr_FR');
			
			$username = $faker->userName;
			
			$user = new User();
			$user->setMail($faker->email);
			$user->setUsername($username);
			$user->setValidated(false);
			$password = $this->encoder->encodePassword($user, $username);
			$user->setPassword($password);
			$user->setCreatedAt(new DateTimeImmutable('-1 year', new DateTimeZone('Europe/Paris')));
			$user->setLastConnexion(new DateTimeImmutable('-1 year', new DateTimeZone('Europe/Paris')));
			
			$manager->persist($user);
			
			$this->addReference('user', $user);
			$manager->flush();
		}
	}