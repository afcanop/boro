<?php

namespace App\Entity;

use App\Repository\PerfilRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerfilRepository::class)]
class Perfil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre1 = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre2 = null;

    #[ORM\Column(length: 255)]
    private ?string $apellido1 = null;

    #[ORM\Column(length: 255)]
    private ?string $apellido2 = null;

    #[ORM\Column(length: 255)]
    private ?string $numeroIdentificacion = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaNacimiento = null;

    #[ORM\Column(length: 255)]
    private ?string $celular = null;

    #[ORM\Column(length: 255)]
    private ?string $correo = null;

    #[ORM\Column(length: 255)]
    private ?string $codigoUsuarioFk = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $sexo = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $genero = null;

    #[ORM\Column]
    private ?int $tipoIdentificacionFk = null;

    #[ORM\ManyToOne(targetEntity: TipoIdentificacion::class, inversedBy: 'tipoIdentificacionPerfil')]
    #[ORM\JoinColumn(name: 'tipoIdentificacionFk', referencedColumnName: 'id')]
    private $tipoIdentificacionRel;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre1(): ?string
    {
        return $this->nombre1;
    }

    public function setNombre1(string $nombre1): self
    {
        $this->nombre1 = $nombre1;

        return $this;
    }

    public function getNombre2(): ?string
    {
        return $this->nombre2;
    }

    public function setNombre2(string $nombre2): self
    {
        $this->nombre2 = $nombre2;

        return $this;
    }

    public function getApellido1(): ?string
    {
        return $this->apellido1;
    }

    public function setApellido1(string $apellido1): self
    {
        $this->apellido1 = $apellido1;

        return $this;
    }

    public function getApellido2(): ?string
    {
        return $this->apellido2;
    }

    public function setApellido2(string $apellido2): self
    {
        $this->apellido2 = $apellido2;

        return $this;
    }

    public function getNumeroIdentificacion(): ?string
    {
        return $this->numeroIdentificacion;
    }

    public function setNumeroIdentificacion(string $numeroIdentificacion): self
    {
        $this->numeroIdentificacion = $numeroIdentificacion;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(\DateTimeInterface $fechaNacimiento): self
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getCelular(): ?string
    {
        return $this->celular;
    }

    public function setCelular(string $celular): self
    {
        $this->celular = $celular;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): self
    {
        $this->correo = $correo;

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

    /**
     * @return string|null
     */
    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    /**
     * @param string|null $sexo
     */
    public function setSexo(?string $sexo): void
    {
        $this->sexo = $sexo;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(?string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipoIdentificacionRel()
    {
        return $this->tipoIdentificacionRel;
    }

    /**
     * @param mixed $tipoIdentificacionRel
     */
    public function setTipoIdentificacionRel($tipoIdentificacionRel): void
    {
        $this->tipoIdentificacionRel = $tipoIdentificacionRel;
    }

    public function getTipoIdentificacionFk(): ?int
    {
        return $this->tipoIdentificacionFk;
    }

    public function setTipoIdentificacionFk(int $tipoIdentificacionFk): self
    {
        $this->tipoIdentificacionFk = $tipoIdentificacionFk;

        return $this;
    }


}
