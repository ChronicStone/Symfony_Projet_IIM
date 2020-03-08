<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     * @Assert\Length(min=1,max=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotNull
     * @Assert\Length(min=1,max=255)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotNull
     * @Assert\Length(min=1,max=1024)
     */
    private $qty;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotNull
     * @Assert\Length(min=1,max=255)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="produits")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $categorie;

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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getQty(): ?float
    {
        return $this->qty;
    }

    public function setQty(float $qty): self
    {
        $this->qty = $qty;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
