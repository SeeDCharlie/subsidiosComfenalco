<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anexos
 *
 * @ORM\Table(name="ANEXOS", indexes={@ORM\Index(name="fkIdx_165", columns={"ID_SUBSIDIOS"}), @ORM\Index(name="fkIdx_177", columns={"ID_PROG_REQ"})})
 * @ORM\Entity
 */
class Anexos
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_ANEXO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAnexo;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=45, nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="string", length=45, nullable=false)
     */
    private $observaciones;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_SUBSIDIOS", type="integer", nullable=false)
     */
    private $idSubsidios;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO", type="string", length=45, nullable=false)
     */
    private $documento;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_PROG_REQ", type="integer", nullable=false)
     */
    private $idProgReq;

    public function getIdAnexo(): ?int
    {
        return $this->idAnexo;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function getIdSubsidios(): ?int
    {
        return $this->idSubsidios;
    }

    public function setIdSubsidios(int $idSubsidios): self
    {
        $this->idSubsidios = $idSubsidios;

        return $this;
    }

    public function getDocumento(): ?string
    {
        return $this->documento;
    }

    public function setDocumento(string $documento): self
    {
        $this->documento = $documento;

        return $this;
    }

    public function getIdProgReq(): ?int
    {
        return $this->idProgReq;
    }

    public function setIdProgReq(int $idProgReq): self
    {
        $this->idProgReq = $idProgReq;

        return $this;
    }


}
