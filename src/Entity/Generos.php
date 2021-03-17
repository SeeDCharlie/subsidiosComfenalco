<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Generos
 *
 * @ORM\Table(name="GENEROS")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\GenerosRepository")
 */
class Generos
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_GENERO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGenero;

    /**
     * @var string
     *
     * @ORM\Column(name="GENERO", type="string", length=45, nullable=false)
     */
    private $genero;

    public function getIdGenero(): ?int
    {
        return $this->idGenero;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }


}
