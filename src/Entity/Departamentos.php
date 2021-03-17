<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departamentos
 *
 * @ORM\Table(name="DEPARTAMENTOS", indexes={@ORM\Index(name="fkIdx_21", columns={"ID_PAIS"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\DepartamentosRepository")
 */
class Departamentos
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_DEPARTAMENTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDepartamento;

    /**
     * @var string
     *
     * @ORM\Column(name="DEPARTAMENTO", type="string", length=80, nullable=false)
     */
    private $departamento;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_PAIS", type="integer", nullable=false)
     */
    private $idPais;

    public function getIdDepartamento(): ?int
    {
        return $this->idDepartamento;
    }

    public function getDepartamento(): ?string
    {
        return $this->departamento;
    }

    public function setDepartamento(string $departamento): self
    {
        $this->departamento = $departamento;

        return $this;
    }

    public function getIdPais(): ?int
    {
        return $this->idPais;
    }

    public function setIdPais(int $idPais): self
    {
        $this->idPais = $idPais;

        return $this;
    }


}
