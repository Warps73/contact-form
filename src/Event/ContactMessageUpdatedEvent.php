<?php

namespace App\Event;

use App\Entity\ContactMessage;
use Symfony\Contracts\EventDispatcher\Event;

class ContactMessageUpdatedEvent extends Event
{
    public const NAME = 'contact.message.updated';

    protected $contactMessage;
    private string $fileType = 'json';

    public function __construct(ContactMessage $contactMessage, ?string $fileType)
    {
        $this->contactMessage = $contactMessage;
        $this->fileType = $fileType;
    }

    public function getContactMessage(): ContactMessage
    {
        return $this->contactMessage;
    }

    public function getFileType(): string
    {
        return $this->fileType;
    }
}
