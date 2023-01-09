<?php

namespace App\Entity;

use App\Repository\SauceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SauceRepository::class)
 */
class Sauce
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
    private $nomSauce;

    /**
     * @ORM\Column(type="float")
     */
    private $prixSauce;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageSauce;

    /**
     * @ORM\ManyToMany(targetEntity=Menu::class, inversedBy="sauces")
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

    public function getNomSauce(): ?string
    {
        return $this->nomSauce;
    }

    public function setNomSauce(string $nomSauce): self
    {
        $this->nomSauce = $nomSauce;

        return $this;
    }

    public function getPrixSauce(): ?float
    {
        return $this->prixSauce;
    }

    public function setPrixSauce(float $prixSauce): self
    {
        $this->prixSauce = $prixSauce;

        return $this;
    }

    public function getImageSauce(): ?string
    {
        return $this->imageSauce;
    }

    public function setImageSauce(?string $imageSauce): self
    {
        $this->imageSauce = $imageSauce;

        return $this;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        $this->menus->removeElement($menu);

        return $this;
    }
}
