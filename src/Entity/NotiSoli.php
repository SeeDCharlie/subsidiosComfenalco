<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NotiSoli
 *
 * @ORM\Table(name="NOTI_SOLI", indexes={@ORM\Index(name="fkIdx_83", columns={"ID_NOTIFICACION"}), @ORM\Index(name="fkIdx_141", columns={"ID_SUBSIDIOS"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\NotiSoliRepository")
 */
class NotiSoli
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_NOTI_SOLI", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNotiSoli;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_NOTIFICACION", type="integer", nullable=false)
     */
    private $idNotificacion;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_SUBSIDIOS", type="integer", nullable=false)
     */
    private $idSubsidios;

    /**
     * @var int
     *
     * @ORM\Column(name="mensaje", type="string", length=45, nullable=false)
     */
    private $mensaje;

    public function getMensaje(): ?string
    {
        return $this->mensaje;
    }
    
    public function setMensaje(string $mensaje): self
    {
        $this->mensaje = $mensaje;
        return $this;
    }

    public function getIdNotiSoli(): ?int
    {
        return $this->idNotiSoli;
    }

    public function getIdNotificacion(): ?int
    {
        return $this->idNotificacion;
    }

    public function setIdNotificacion(int $idNotificacion): self
    {
        $this->idNotificacion = $idNotificacion;

        return $this;
    }

    public function getIdSubsidios(): ?int
    {
        return $this->idSubsidios;
    }

    public function setIdSubsidios(int $idSubsidios): self
    {
        $this->idSubsidios = $idSubsidios;

        return $this;
    }


}
