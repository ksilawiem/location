<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $votrelieu;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lieualler;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $tel;

    /**
     * @ORM\Column(type="date")
     */
    private $datevoyage;

    /**
     * @ORM\Column(type="date")
     */
    private $dateretour;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contact", mappedBy="villes")
     */
    private $contacts;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVotrelieu(): ?string
    {
        return $this->votrelieu;
    }

    public function setVotrelieu(string $votrelieu): self
    {
        $this->votrelieu = $votrelieu;

        return $this;
    }

    public function getLieualler(): ?string
    {
        return $this->lieualler;
    }

    public function setLieualler(string $lieualler): self
    {
        $this->lieualler = $lieualler;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getDatevoyage(): ?\DateTimeInterface
    {
        return $this->datevoyage;
    }

    public function setDatevoyage(\DateTimeInterface $datevoyage): self
    {
        $this->datevoyage = $datevoyage;

        return $this;
    }

    public function getDateretour(): ?\DateTimeInterface
    {
        return $this->dateretour;
    }

    public function setDateretour(\DateTimeInterface $dateretour): self
    {
        $this->dateretour = $dateretour;

        return $this;
    }

    public function getVilles(): ?self
    {
        return $this->villes;
    }

    public function setVilles(?self $villes): self
    {
        $this->villes = $villes;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(self $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setVilles($this);
        }

        return $this;
    }

    public function removeContact(self $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            // set the owning side to null (unless already changed)
            if ($contact->getVilles() === $this) {
                $contact->setVilles(null);
            }
        }

        return $this;
    }
}
