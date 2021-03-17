<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notificaciones
 *
 * @ORM\Table(name="NOTIFICACIONES")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\NotificacionesRepository")
 */
class Notificaciones
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_NOTIFICACION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNotificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="NOTIFICACION", type="string", length=200, nullable=false)
     */
    private $notificacion;

    public function getIdNotificacion(): ?int
    {
        return $this->idNotificacion;
    }

    public function getNotificacion(): ?string
    {
        return $this->notificacion;
    }

    public function setNotificacion(string $notificacion): self
    {
        $this->notificacion = $notificacion;

        return $this;
    }


}
