<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoUsuario
 *
 * @ORM\Table(name="TIPO_USUARIO")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\TipoUsuarioRepository")
 */
class TipoUsuario
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_TIPO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTipo;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_USUARIO", type="string", length=45, nullable=false)
     */
    private $tipoUsuario;

    public function getIdTipo(): ?int
    {
        return $this->idTipo;
    }

    public function getTipoUsuario(): ?string
    {
        return $this->tipoUsuario;
    }

    public function setTipoUsuario(string $tipoUsuario): self
    {
        $this->tipoUsuario = $tipoUsuario;

        return $this;
    }


}
