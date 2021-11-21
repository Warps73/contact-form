<?php

namespace App\Service\Generator;

use App\Entity\ContactMessage;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;

class ContactMessageToJsonFileGenerator
{

    public const EXPORT_FOLDER = 'export';

    protected Filesystem $filesystem;
    protected KernelInterface $kernel;

    public function __construct(
        Filesystem $filesystem,
        KernelInterface $kernel
    ) {
        $this->filesystem = $filesystem;
        $this->kernel = $kernel;
    }

    public function generateFile(ContactMessage $contactMessage)
    {

        $directory = $this->kernel->getProjectDir().'/'.self::EXPORT_FOLDER;
        $this->filesystem->mkdir($directory);

        $json = json_encode([
            'email' => $contactMessage->getContactUser()->getEmail(),
            'name' => $contactMessage->getName(),
            'message' => $contactMessage->getMessage(),

        ]);
        $this->filesystem->dumpFile($directory.'/contact-message-'.$contactMessage->getId().'.json', $json);
    }
}
