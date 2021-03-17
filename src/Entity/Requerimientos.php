<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Requerimientos
 *
 * @ORM\Table(name="REQUERIMIENTOS")
 * @ORM\Entity
 */
class Requerimientos
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_REQUERIMIENTOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRequerimientos;

    /**
     * @var string
     *
     * @ORM\Column(name="REQUERIMIENTO", type="string", length=200, nullable=false)
     */
    private $requerimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="INFO_REQUERIMIENTO", type="string", length=500, nullable=false)
     */
    private $infoRequerimiento;

    public function getIdRequerimientos(): ?int
    {
        return $this->idRequerimientos;
    }

    public function getRequerimiento(): ?string
    {
        return $this->requerimiento;
    }

    public function setRequerimiento(string $requerimiento): self
    {
        $this->requerimiento = $requerimiento;

        return $this;
    }

    public function getInfoRequerimiento(): ?string
    {
        return $this->infoRequerimiento;
    }

    public function setInfoRequerimiento(string $infoRequerimiento): self
    {
        $this->infoRequerimiento = $infoRequerimiento;

        return $this;
    }


}
