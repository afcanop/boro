<?php

namespace App\Entity;

use App\Repository\ExperienciaProfesionalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExperienciaProfesionalRepository::class)]
class ExperienciaProfesional
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $compañia = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcionCargo = null;

    #[ORM\Column]
    private ?bool $estadoActivo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaDesde = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaHasta = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompañia(): ?string
    {
        return $this->compañia;
    }

    public function setCompañia(string $compañia): self
    {
        $this->compañia = $compañia;

        return $this;
    }

    public function getDescripcionCargo(): ?string
    {
        return $this->descripcionCargo;
    }

    public function setDescripcionCargo(string $descripcionCargo): self
    {
        $this->$descripcionCargo = $descripcionCargo;

        return $this;
    }

    public function isEstadoActivo(): ?bool
    {
        return $this->estadoActivo;
    }

    public function setEstadoActivo(bool $estadoActivo): self
    {
        $this->estadoActivo = $estadoActivo;

        return $this;
    }

    public function getFechaDesde(): ?\DateTimeInterface
    {
        return $this->fechaDesde;
    }

    public function setFechaDesde(\DateTimeInterface $fechaDesde): self
    {
        $this->fechaDesde = $fechaDesde;

        return $this;
    }

    public function getFechaHasta(): ?\DateTimeInterface
    {
        return $this->fechaHasta;
    }

    public function setFechaHasta(\DateTimeInterface $fechaHasta): self
    {
        $this->fechaHasta = $fechaHasta;

        return $this;
    }
}
