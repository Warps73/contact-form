<?php

namespace App\Tests\Controller;

use App\Repository\ContactMessageRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


// todo implement auto rollback for the database
class ContactControllerTest extends WebTestCase
{
    public function testContact()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
    }

    public function testNewContactMessage()
    {

        $client = static::createClient();
        $client->request('GET', '/');

        $client->submitForm('Submit', [
            'contact[contactUser][email]' => 'test@test.com',
            'contact[name]' => 'name',
            'contact[message]' => 'message',
        ]);

        self::assertResponseRedirects();

        $repo = self::getContainer()->get(ContactMessageRepository::class);

        self::assertCount(1, $repo->findAll());

    }
}
