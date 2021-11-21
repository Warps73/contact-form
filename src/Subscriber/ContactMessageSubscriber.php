<?php

namespace App\Subscriber;

use App\Event\ContactMessageUpdatedEvent;
use App\Service\Generator\ContactMessageToJsonFileGenerator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ContactMessageSubscriber implements EventSubscriberInterface
{
    private ContactMessageToJsonFileGenerator $contactUserToJsonFileGenerator;

    public function __construct(
        ContactMessageToJsonFileGenerator $contactUserToJsonFileGenerator
    ) {
        $this->contactUserToJsonFileGenerator = $contactUserToJsonFileGenerator;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ContactMessageUpdatedEvent::class => [
                ['generateFile', 0],
            ],
        ];
    }

    public function generateFile(ContactMessageUpdatedEvent $event): void
    {
        $this->contactUserToJsonFileGenerator->generateFile($event->getContactMessage());
    }
}
