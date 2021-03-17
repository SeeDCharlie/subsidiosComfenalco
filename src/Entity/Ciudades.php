<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ciudades
 *
 * @ORM\Table(name="CIUDADES", indexes={@ORM\Index(name="fkIdx_12", columns={"ID_DEPARTAMENTO"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\CiudadesRepository")
 */
class Ciudades
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_CIUDAD", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCiudad;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_DEPARTAMENTO", type="integer", nullable=false)
     */
    private $idDepartamento;

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD", type="string", length=45, nullable=false)
     */
    private $ciudad;

    public function getIdCiudad(): ?int
    {
        return $this->idCiudad;
    }

    public function getIdDepartamento(): ?int
    {
        return $this->idDepartamento;
    }

    public function setIdDepartamento(int $idDepartamento): self
    {
        $this->idDepartamento = $idDepartamento;

        return $this;
    }

    public function getCiudad(): ?string
    {
        return $this->ciudad;
    }

    public function setCiudad(string $ciudad): self
    {
        $this->ciudad = $ciudad;

        return $this;
    }


}
