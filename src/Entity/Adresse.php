<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private int $siret;

    #[ORM\Column]
    private bool $siege;

    public function getId(): int
    {
        return $this->id;
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
