<?php

namespace App\Tests\Unit\Service\Generator;

use App\Entity\ContactMessage;
use App\Entity\ContactUser;
use App\Service\Generator\ContactMessageToJsonFileGenerator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;

class ContactMessageToJsonFileGeneratorTest extends KernelTestCase
{
    protected function setUp(): void
    {
        $kernel = $this->getContainer()->get(KernelInterface::class);
        $directory = $kernel->getProjectDir().'/'.ContactMessageToJsonFileGenerator::EXPORT_FOLDER;
        if (file_exists($directory.'/contact-message-.json')) {
            unlink($directory.'/contact-message-.json');
        }
        parent::setUp();
    }


    protected function tearDown(): void
    {
        $kernel = $this->getContainer()->get(KernelInterface::class);
        $directory = $kernel->getProjectDir().'/'.ContactMessageToJsonFileGenerator::EXPORT_FOLDER;
        if (file_exists($directory.'/contact-message-.json')) {
            unlink($directory.'/contact-message-.json');
        }
        parent::tearDown();
    }


    public function testGenerateFile()
    {
        $generator = $this->getContainer()->get(ContactMessageToJsonFileGenerator::class);
        $contactUser = (new ContactUser())
            ->setEmail('testy@test.com');

        $contactMessage = (new ContactMessage())
            ->setMessage('message')
            ->setName('name')
            ->setContactUser($contactUser);


        $generator->generateFile($contactMessage);

        $kernel = $this->getContainer()->get(KernelInterface::class);
        $directory = $kernel->getProjectDir().'/'.ContactMessageToJsonFileGenerator::EXPORT_FOLDER;
        self::assertTrue(file_exists($directory.'/contact-message-.json'));

    }
}
