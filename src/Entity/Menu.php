<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=MenuRepository::class)
 * @UniqueEntity(
 *      fields={"nomMenu"},
 *      message="Le nom du menu est déja utilisé."
 * )
 */
class Menu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom est obligatoire")
     */
    private $nomMenu;

    /**
     * @ORM\Column(type="float")
     */
    private $prixMenu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageMenu;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionMenu;


    /**
     * @ORM\ManyToMany(targetEntity=Commande::class, inversedBy="menus")
     */
    private $Commande;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="menu")
     */
    private $type;



    /**
     * @ORM\ManyToOne(targetEntity=Boisson::class, inversedBy="menu")
     */
    private $boissons;

    /**
     * @ORM\ManyToOne(targetEntity=Sauce::class, inversedBy="menus")
     */
    private $sauces;

    /**
     * @ORM\ManyToOne(targetEntity=Accompagnement::class, inversedBy="menu")
     */
    private $accompagnements;


    public function __construct()
    {
        $this->Commande = new ArrayCollection();
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

    public function getNomMenu(): ?string
    {
        return $this->nomMenu;
    }

    public function setNomMenu(string $nomMenu): self
    {
        $this->nomMenu = $nomMenu;

        return $this;
    }

    public function getPrixMenu(): ?float
    {
        return $this->prixMenu;
    }

    public function setPrixMenu(float $prixMenu): self
    {
        $this->prixMenu = $prixMenu;

        return $this;
    }

    public function getImageMenu(): ?string
    {
        return $this->imageMenu;
    }

    public function setImageMenu(string $imageMenu): self
    {
        $this->imageMenu = $imageMenu;

        return $this;
    }

    public function getDescriptionMenu(): ?string
    {
        return $this->descriptionMenu;
    }

    public function setDescriptionMenu(?string $descriptionMenu): self
    {
        $this->descriptionMenu = $descriptionMenu;

        return $this;
    }

  
    /**
     * @return Collection<int, Commande>
     */
    public function getCommande(): Collection
    {
        return $this->Commande;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->Commande->contains($commande)) {
            $this->Commande[] = $commande;
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        $this->Commande->removeElement($commande);

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }


    public function getBoissons(): ?Boisson
    {
        return $this->boissons;
    }

    public function setBoissons(?Boisson $boissons): self
    {
        $this->boissons = $boissons;

        return $this;
    }

    public function getSauces(): ?Sauce
    {
        return $this->sauces;
    }

    public function setSauces(?Sauce $sauces): self
    {
        $this->sauces = $sauces;

        return $this;
    }

    public function getAccompagnements(): ?Accompagnement
    {
        return $this->accompagnements;
    }

    public function setAccompagnements(?Accompagnement $accompagnements): self
    {
        $this->accompagnements = $accompagnements;

        return $this;
    }

}
