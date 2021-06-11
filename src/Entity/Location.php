<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationRepository")
 */
class Location
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $datedebut;

    /**
     * @ORM\Column(type="date")
     */
    private $datefin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="locations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clients;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Voiture", inversedBy="locations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voitures;

    /**
     * @ORM\Column(type="integer")
     */
    private $valider;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(\DateTimeInterface $datefin): self
    {
        $this->datefin = $datefin;

        return $this;
    }

    public function getClients(): ?Client
    {
        return $this->clients;
    }

    public function setClients(?Client $clients): self
    {
        $this->clients = $clients;

        return $this;
    }

    public function getVoitures(): ?Voiture
    {
        return $this->voitures;
    }

    public function setVoitures(?Voiture $voitures): self
    {
        $this->voitures = $voitures;

        return $this;
    }

    public function getValider(): ?int
    {
        return $this->valider;
    }

    public function setValider(int $valider): self
    {
        $this->valider = $valider;

        return $this;
    }

}
