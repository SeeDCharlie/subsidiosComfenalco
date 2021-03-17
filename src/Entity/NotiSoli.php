<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NotiSoli
 *
 * @ORM\Table(name="NOTI_SOLI", indexes={@ORM\Index(name="fkIdx_83", columns={"ID_NOTIFICACION"}), @ORM\Index(name="fkIdx_141", columns={"ID_SUBSIDIOS"})})
 * @ORM\Entity
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
