<?php

namespace App\Entity;

use App\Repository\LignePrescriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LignePrescriptionRepository::class)]
class LignePrescription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'lignePrescriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ordonnance $numeroOrdre = null;

    #[ORM\ManyToOne(inversedBy: 'lignePrescriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Medicament $denomination = null;

    #[ORM\Column(length: 255)]
    private ?string $posologie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroOrdre(): ?Ordonnance
    {
        return $this->numeroOrdre;
    }

    public function setNumeroOrdre(?Ordonnance $numeroOrdre): self
    {
        $this->numeroOrdre = $numeroOrdre;

        return $this;
    }

    public function getDenomination(): ?Medicament
    {
        return $this->denomination;
    }

    public function setDenomination(?Medicament $denomination): self
    {
        $this->denomination = $denomination;

        return $this;
    }

    public function getPosologie(): ?string
    {
        return $this->posologie;
    }

    public function setPosologie(string $posologie): self
    {
        $this->posologie = $posologie;

        return $this;
    }
}
