<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Programas
 *
 * @ORM\Table(name="PROGRAMAS", indexes={@ORM\Index(name="fkIdx_130", columns={"ID_ESTADO"})})
 * @ORM\Entity
 */
class Programas
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_PROGRAMA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPrograma;

    /**
     * @var string
     *
     * @ORM\Column(name="PROGRAMA", type="string", length=45, nullable=false)
     */
    private $programa;

    /**
     * @var string
     *
     * @ORM\Column(name="INFO_PROGRAMA", type="string", length=1000, nullable=false)
     */
    private $infoPrograma;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_ESTADO", type="integer", nullable=false)
     */
    private $idEstado;

    public function getIdPrograma(): ?int
    {
        return $this->idPrograma;
    }

    public function getPrograma(): ?string
    {
        return $this->programa;
    }

    public function setPrograma(string $programa): self
    {
        $this->programa = $programa;

        return $this;
    }

    public function getInfoPrograma(): ?string
    {
        return $this->infoPrograma;
    }

    public function setInfoPrograma(string $infoPrograma): self
    {
        $this->infoPrograma = $infoPrograma;

        return $this;
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


}
