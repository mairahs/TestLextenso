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
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\EqualTo(
        value: 9,
    )]
    private string $siren;
    
    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\EqualTo(
        value: 14,
    )]
    private string $siret;

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

    public function getSiren(): string
    {
        return $this->siren;
    }

    public function setSiren(string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getSiret(): string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
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
