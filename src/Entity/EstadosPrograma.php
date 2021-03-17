<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstadosPrograma
 *
 * @ORM\Table(name="ESTADOS_PROGRAMA")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\EstadosProgramaRepository")
 */
class EstadosPrograma
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
     * @ORM\Column(name="ESTADOS", type="string", length=45, nullable=false)
     */
    private $estados;

    public function getIdEstado(): ?int
    {
        return $this->idEstado;
    }

    public function getEstados(): ?string
    {
        return $this->estados;
    }

    public function setEstados(string $estados): self
    {
        $this->estados = $estados;

        return $this;
    }


}
