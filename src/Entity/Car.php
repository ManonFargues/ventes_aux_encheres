<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */
class Car
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
    private $model;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\OneToOne(targetEntity="Image", cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="Keyword", mappedBy="car", cascade={"persist", "remove"})
     */
    private $keywords;

    public function __construct()
    {
        $this->keywords = new ArrayCollection();
    }

    public function getKeywords()
    {
        return $this->keywords;
    }

    public function addKeyword(Keyword $keyword)
    {
        $this->keywords->add($keyword);
        $keyword->setCar($this);
    }

    public function removeKeyword(Keyword $keyword)
    {
        $this->keywords->removeElement($keyword);
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }
/*
    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="car")
     */
    /*
    private $user;
    */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
