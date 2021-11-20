<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {

        $administrator = (new User())
            ->setEmail('admin@company.com')
            ->setRoles(['ROLE_ADMIN']);
        $administrator->setPassword(
            $this->passwordEncoder->hashPassword(
                $administrator,
                'admin'
            )
        );

        $manager->persist($administrator);
        $manager->flush();
    }
}
