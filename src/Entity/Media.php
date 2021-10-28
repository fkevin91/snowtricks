<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MediaRepository::class)
 */
class Media
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lien;

    /**
     * @ORM\Column(type="boolean")
     */
    private $typeMedia;

    /**
     * @ORM\ManyToOne(targetEntity=Snowtricks::class, inversedBy="media")
     * @ORM\JoinColumn(nullable=false)
     */
    private $snowtrickId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }

    public function getTypeMedia(): ?bool
    {
        return $this->typeMedia;
    }

    public function setTypeMedia(bool $typeMedia): self
    {
        $this->typeMedia = $typeMedia;

        return $this;
    }

    public function getSnowtrickId(): ?Snowtricks
    {
        return $this->snowtrickId;
    }

    public function setSnowtrickId(?Snowtricks $snowtrickId): self
    {
        $this->snowtrickId = $snowtrickId;

        return $this;
    }
}
