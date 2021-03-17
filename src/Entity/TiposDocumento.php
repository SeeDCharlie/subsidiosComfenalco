<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TiposDocumento
 *
 * @ORM\Table(name="TIPOS_DOCUMENTO")
 * @ORM\Entity
 */
class TiposDocumento
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_TIPO_DOC", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTipoDoc;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO", type="string", length=45, nullable=false)
     */
    private $documento;

    public function getIdTipoDoc(): ?int
    {
        return $this->idTipoDoc;
    }

    public function getDocumento(): ?string
    {
        return $this->documento;
    }

    public function setDocumento(string $documento): self
    {
        $this->documento = $documento;

        return $this;
    }


}
