<?php

namespace App\Entity;

use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablissementRepository::class)]
class Etablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private int $siren;

    #[ORM\Column]
    private int $siret;

    #[ORM\Column]
    private bool $siege;

    #[ORM\OneToMany(mappedBy: 'etablissement', targetEntity: Adresse::class, orphanRemoval: true)]
    private Collection $adresses;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSiren(): int
    {
        return $this->siren;
    }

    public function setSiren(int $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getSiret(): int
    {
        return $this->siret;
    }

    public function setSiret(int $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function isSiege(): bool
    {
        return $this->siege;
    }

    public function setSiege(bool $siege): self
    {
        $this->siege = $siege;

        return $this;
    }

    /**
     * @return Collection<int, Adresse>
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses->add($adress);
            $adress->setEtablissement($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getEtablissement() === $this) {
                $adress->setEtablissement(null);
            }
        }

        return $this;
    }
}
