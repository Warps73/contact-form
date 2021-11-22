<?php

namespace App\Entity;

use App\Repository\ContactUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContactUserRepository::class)
 * @ORM\Table(
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"email"})}
 *     )
 */
class ContactUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(mode="strict")
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=ContactMessage::class, mappedBy="contactUser", orphanRemoval=true)
     */
    private $contactMessages;

    public function __construct()
    {
        $this->contactMessages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|ContactMessage[]
     */
    public function getContactMessages(): Collection
    {
        return $this->contactMessages;
    }

    public function addContactMessage(ContactMessage $message): self
    {
        if (!$this->contactMessages->contains($message)) {
            $this->contactMessages[] = $message;
            $message->setContactUser($this);
        }

        return $this;
    }

    public function removeContactMessage(ContactMessage $message): self
    {
        if ($this->contactMessages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getContactUser() === $this) {
                $message->setContactUser(null);
            }
        }

        return $this;
    }
}
