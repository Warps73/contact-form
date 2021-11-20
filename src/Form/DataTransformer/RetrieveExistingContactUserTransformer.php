<?php

namespace App\Form\DataTransformer;

use App\Entity\ContactUser;
use App\Repository\ContactUserRepository;
use Symfony\Component\Form\DataTransformerInterface;

class RetrieveExistingContactUserTransformer implements DataTransformerInterface
{
    private ContactUserRepository $contactUserRepository;

    public function __construct(ContactUserRepository $contactUserRepository)
    {
        $this->contactUserRepository = $contactUserRepository;
    }

    public function transform($value)
    {
        return $value;
    }

    /**
     * Could retrieve an existing ContactUser
     * and return it or return the original data
     *
     * @param ContactUser $value
     */
    public function reverseTransform($value): ContactUser
    {

        return $this->contactUserRepository->findOneBy(['email' => $value->getEmail()]) ?? $value;
    }


}
