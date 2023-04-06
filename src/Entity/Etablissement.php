<?php

namespace App\Entity;

use App\Repository\EtablissementRepository;
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
}
