<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subsidios
 *
 * @ORM\Table(name="SUBSIDIOS", indexes={@ORM\Index(name="fkIdx_154", columns={"ID_PROGRAMA"}), @ORM\Index(name="fkIdx_64", columns={"ID_ESTADO"}), @ORM\Index(name="fkIdx_61", columns={"ID_USUARIO"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\SubsidiosRepository")
 */
class Subsidios
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_SUBSIDIOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSubsidios;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_ESTADO", type="integer", nullable=false)
     */
    private $idEstado;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_USUARIO", type="integer", nullable=false)
     */
    private $idUsuario;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_PROGRAMA", type="integer", nullable=false)
     */
    private $idPrograma;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CREACION", type="date", nullable=false)
     */
    private $fechaCreacion;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FECHA_MODIFICACION", type="date", nullable=true)
     */
    private $fechaModificacion;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FECHA_FINALIZACION", type="date", nullable=true)
     */
    private $fechaFinalizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="FORMULARIO", type="string", length=100, nullable=false)
     */
    private $formulario;

    public function getIdSubsidios(): ?int
    {
        return $this->idSubsidios;
    }

    public function getIdEstado(): ?int
    {
        return $this->idEstado;
    }

    public function setIdEstado(int $idEstado): self
    {
        $this->idEstado = $idEstado;

        return $this;
    }

    public function getIdUsuario(): ?int
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(int $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    public function getIdPrograma(): ?int
    {
        return $this->idPrograma;
    }

    public function setIdPrograma(int $idPrograma): self
    {
        $this->idPrograma = $idPrograma;

        return $this;
    }

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion(\DateTimeInterface $fechaCreacion): self
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    public function getFechaModificacion(): ?\DateTimeInterface
    {
        return $this->fechaModificacion;
    }

    public function setFechaModificacion(?\DateTimeInterface $fechaModificacion): self
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    public function getFechaFinalizacion(): ?\DateTimeInterface
    {
        return $this->fechaFinalizacion;
    }

    public function setFechaFinalizacion(?\DateTimeInterface $fechaFinalizacion): self
    {
        $this->fechaFinalizacion = $fechaFinalizacion;

        return $this;
    }

    public function getFormulario(): ?string
    {
        return $this->formulario;
    }

    public function setFormulario(string $formulario): self
    {
        $this->formulario = $formulario;

        return $this;
    }


}
