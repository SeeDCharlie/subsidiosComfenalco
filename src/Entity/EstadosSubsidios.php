<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstadosSubsidios
 *
 * @ORM\Table(name="ESTADOS_SUBSIDIOS")
 * @ORM\Entity
 */
class EstadosSubsidios
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_ESTADO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEstado;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=45, nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="INFO_ESTADO", type="string", length=700, nullable=false)
     */
    private $infoEstado;

    public function getIdEstado(): ?int
    {
        return $this->idEstado;
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

    public function getInfoEstado(): ?string
    {
        return $this->infoEstado;
    }

    public function setInfoEstado(string $infoEstado): self
    {
        $this->infoEstado = $infoEstado;

        return $this;
    }


}
