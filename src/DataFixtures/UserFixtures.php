<?php
	use App\Entity\User;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\Persistence\ObjectManager;
	use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
	
	class UserFixtures extends Fixture
	{
		private $encoder;
		
		public function __construct(UserPasswordEncoderInterface $encoder)
		{
			$this->encoder = $encoder;
		}
		
		/**
		 * @inheritDoc
		 * @throws Exception
		 */
		public function load(ObjectManager $manager)
		{
			$user = new User();
			$user->setMail('admin');
			$user->setValidated(false);
			$password = $this->encoder->encodePassword($user, 'pass1234');
			$user->setPassword($password);
			
			$manager->persist($user);
			$manager->flush();
		}
	}