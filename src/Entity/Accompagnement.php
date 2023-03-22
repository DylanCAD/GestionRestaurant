<?php

namespace App\Entity;

use App\Repository\AccompagnementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccompagnementRepository::class)
 */
class Accompagnement
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
    private $nomAccompagnement;

    /**
     * @ORM\Column(type="float")
     */
    private $prixAccompagnement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, nullable=true)
     */
    private $imageAccompagnement;

    /**
     * @ORM\OneToMany(targetEntity=Menu::class, mappedBy="accompagnements")
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

    public function getNomAccompagnement(): ?string
    {
        return $this->nomAccompagnement;
    }

    public function setNomAccompagnement(string $nomAccompagnement): self
    {
        $this->nomAccompagnement = $nomAccompagnement;

        return $this;
    }

    public function getPrixAccompagnement(): ?float
    {
        return $this->prixAccompagnement;
    }

    public function setPrixAccompagnement(float $prixAccompagnement): self
    {
        $this->prixAccompagnement = $prixAccompagnement;

        return $this;
    }

    public function getImageAccompagnement(): ?string
    {
        return $this->imageAccompagnement;
    }

    public function setImageAccompagnement(?string $imageAccompagnement): self
    {
        $this->imageAccompagnement = $imageAccompagnement;

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
            $menus->setAccompagnements($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menus): self
    {
        if ($this->menus->removeElement($menus)) {
            // set the owning side to null (unless already changed)
            if ($menus->getAccompagnements() === $this) {
                $menus->setAccompagnements(null);
            }
        }

        return $this;
    }
}
