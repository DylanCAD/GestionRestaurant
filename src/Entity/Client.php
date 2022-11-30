<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
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
    private $nomCli;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomCli;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rueCli;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cpCli;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villeCli;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telCli;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="client")
     */
    private $commandes;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
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

    public function getNomCli(): ?string
    {
        return $this->nomCli;
    }

    public function setNomCli(string $nomCli): self
    {
        $this->nomCli = $nomCli;

        return $this;
    }

    public function getPrenomCli(): ?string
    {
        return $this->prenomCli;
    }

    public function setPrenomCli(string $prenomCli): self
    {
        $this->prenomCli = $prenomCli;

        return $this;
    }

    public function getRueCli(): ?string
    {
        return $this->rueCli;
    }

    public function setRueCli(string $rueCli): self
    {
        $this->rueCli = $rueCli;

        return $this;
    }

    public function getCpCli(): ?string
    {
        return $this->cpCli;
    }

    public function setCpCli(string $cpCli): self
    {
        $this->cpCli = $cpCli;

        return $this;
    }

    public function getVilleCli(): ?string
    {
        return $this->villeCli;
    }

    public function setVilleCli(string $villeCli): self
    {
        $this->villeCli = $villeCli;

        return $this;
    }

    public function getTelCli(): ?string
    {
        return $this->telCli;
    }

    public function setTelCli(string $telCli): self
    {
        $this->telCli = $telCli;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setClient($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getClient() === $this) {
                $commande->setClient(null);
            }
        }

        return $this;
    }

}
