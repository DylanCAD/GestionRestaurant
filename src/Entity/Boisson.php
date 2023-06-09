<?php

namespace App\Entity;

use App\Repository\BoissonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BoissonRepository::class)
 */
class Boisson
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="float", length=255)
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity=Menu::class, mappedBy="boissons")
     */
    private $menus;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenu(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menus): self
    {
        if (!$this->menus->contains($menus)) {
            $this->menus[] = $menus;
            $menus->setBoissons($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menus): self
    {
        if ($this->menus->removeElement($menus)) {
            // set the owning side to null (unless already changed)
            if ($menus->getBoissons() === $this) {
                $menus->setBoissons(null);
            }
        }

        return $this;
    }

}
