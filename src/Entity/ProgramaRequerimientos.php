<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProgramaRequerimientos
 *
 * @ORM\Table(name="PROGRAMA_REQUERIMIENTOS", indexes={@ORM\Index(name="fkIdx_49", columns={"ID_REQUERIMIENTOS"}), @ORM\Index(name="fkIdx_157", columns={"ID_PROGRAMA"})})
 * @ORM\Entity
 */
class ProgramaRequerimientos
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_PROG_REQ", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProgReq;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_REQUERIMIENTOS", type="integer", nullable=false)
     */
    private $idRequerimientos;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_PROGRAMA", type="integer", nullable=false)
     */
    private $idPrograma;

    public function getIdProgReq(): ?int
    {
        return $this->idProgReq;
    }

    public function getIdRequerimientos(): ?int
    {
        return $this->idRequerimientos;
    }

    public function setIdRequerimientos(int $idRequerimientos): self
    {
        $this->idRequerimientos = $idRequerimientos;

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


}
