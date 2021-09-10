<?php

namespace App\Entity;

use App\Repository\SnowtricksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SnowtricksRepository::class)
 */
class Snowtricks
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
    private $nom;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $groupeFigure;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $photo = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $video = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getGroupeFigure(): ?string
    {
        return $this->groupeFigure;
    }

    public function setGroupeFigure(string $groupeFigure): self
    {
        $this->groupeFigure = $groupeFigure;

        return $this;
    }

    public function getPhoto(): ?array
    {
        return $this->photo;
    }

    public function setPhoto(?array $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getVideo(): ?array
    {
        return $this->video;
    }

    public function setVideo(array $video): self
    {
        $this->video = $video;

        return $this;
    }
}
