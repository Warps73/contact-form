<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testAdmin()
    {
        $client = static::createClient();
        $client->request('GET', '/admin');
        $this->assertMatchesRegularExpression('/\/login$/', $client->getResponse()->headers->get('location'));
        //
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@company.com');
        $client->loginUser($testUser);
        $client->request('GET', '/admin');
        $this->assertResponseIsSuccessful();
    }
}
