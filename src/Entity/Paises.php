<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paises
 *
 * @ORM\Table(name="PAISES")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\PaisesRepository")
 */
class Paises
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_PAIS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPais;

    /**
     * @var string
     *
     * @ORM\Column(name="PAIS", type="string", length=45, nullable=false)
     */
    private $pais;

    public function getIdPais(): ?int
    {
        return $this->idPais;
    }

    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function setPais(string $pais): self
    {
        $this->pais = $pais;

        return $this;
    }


}
