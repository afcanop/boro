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
    private ?string $compania = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcionCargo = null;

    #[ORM\Column]
    private ?bool $estadoActivo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaDesde = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaHasta = null;

    #[ORM\Column(length: 255)]
    private ?string $codigoUsuarioFk = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getcompania(): ?string
    {
        return $this->compania;
    }

    public function setcompania(string $compania): self
    {
        $this->compania = $compania;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescripcionCargo(): ?string
    {
        return $this->descripcionCargo;
    }

    /**
     * @param string|null $descripcionCargo
     */
    public function setDescripcionCargo(?string $descripcionCargo): void
    {
        $this->descripcionCargo = $descripcionCargo;
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

    public function getCodigoUsuarioFk(): ?string
    {
        return $this->codigoUsuarioFk;
    }

    public function setCodigoUsuarioFk(string $codigoUsuarioFk): self
    {
        $this->codigoUsuarioFk = $codigoUsuarioFk;

        return $this;
    }
}
