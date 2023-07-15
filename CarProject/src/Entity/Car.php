<?php

namespace App\Entity;
use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "integer")]
    private ?int $nbSeats = null;

    #[ORM\Column(type: "integer")]
    private ?int $nbDoors = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private ?string $cost = null;

    #[ORM\ManyToOne(targetEntity: CarCategory::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?CarCategory $category = null;

    // Ajout des getters et setters pour les nouveaux champs
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNbSeats(): ?int
    {
        return $this->nbSeats;
    }

    public function setNbSeats(?int $nbSeats): self
    {
        $this->nbSeats = $nbSeats;

        return $this;
    }

    public function getNbDoors(): ?int
    {
        return $this->nbDoors;
    }

    public function setNbDoors(?int $nbDoors): self
    {
        $this->nbDoors = $nbDoors;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(?string $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getCategory(): ?CarCategory
    {
        return $this->category;
    }

    public function setCategory(?CarCategory $category): self
    {
        $this->category = $category;

        return $this;
    }
}
