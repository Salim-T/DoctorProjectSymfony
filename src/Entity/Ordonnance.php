<?php

namespace App\Entity;

use App\Repository\OrdonnanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdonnanceRepository::class)]
class Ordonnance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numeroOrdre = null;

    #[ORM\ManyToOne(inversedBy: 'ordonnances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patient $NumSS = null;

    #[ORM\ManyToOne(inversedBy: 'ordonnances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Medecin $matricule = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateHeure = null;

    #[ORM\OneToMany(mappedBy: 'numeroOrdre', targetEntity: LignePrescription::class)]
    private Collection $lignePrescriptions;

    public function __construct()
    {
        $this->lignePrescriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroOrdre(): ?string
    {
        return $this->numeroOrdre;
    }

    public function setNumeroOrdre(string $numeroOrdre): self
    {
        $this->numeroOrdre = $numeroOrdre;

        return $this;
    }

    public function getNumSS(): ?Patient
    {
        return $this->NumSS;
    }

    public function setNumSS(?Patient $NumSS): self
    {
        $this->NumSS = $NumSS;

        return $this;
    }

    public function getMatricule(): ?Medecin
    {
        return $this->matricule;
    }

    public function setMatricule(?Medecin $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getDateHeure(): ?\DateTimeInterface
    {
        return $this->dateHeure;
    }

    public function setDateHeure(\DateTimeInterface $dateHeure): self
    {
        $this->dateHeure = $dateHeure;

        return $this;
    }

    /**
     * @return Collection<int, LignePrescription>
     */
    public function getLignePrescriptions(): Collection
    {
        return $this->lignePrescriptions;
    }

    public function addLignePrescription(LignePrescription $lignePrescription): self
    {
        if (!$this->lignePrescriptions->contains($lignePrescription)) {
            $this->lignePrescriptions->add($lignePrescription);
            $lignePrescription->setNumeroOrdre($this);
        }

        return $this;
    }

    public function removeLignePrescription(LignePrescription $lignePrescription): self
    {
        if ($this->lignePrescriptions->removeElement($lignePrescription)) {
            // set the owning side to null (unless already changed)
            if ($lignePrescription->getNumeroOrdre() === $this) {
                $lignePrescription->setNumeroOrdre(null);
            }
        }

        return $this;
    }
}
