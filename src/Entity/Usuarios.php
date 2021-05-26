<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuarios
 *
 * @ORM\Table(name="USUARIOS", indexes={@ORM\Index(name="fkIdx_127", columns={"ID_TIPO_DOC"}), @ORM\Index(name="fkIdx_24", columns={"ID_PAIS"}), @ORM\Index(name="fkIdx_119", columns={"ID_CIUDAD"}), @ORM\Index(name="fkIdx_150", columns={"ID_TIPO_USUARIO"}), @ORM\Index(name="fkIdx_99", columns={"ID_GENERO"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\UsuariosRepository")
 */
class Usuarios
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_USUARIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="APELLIDO", type="string", length=45, nullable=false)
     */
    private $apellido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_NACIMIENTO", type="date", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_GENERO", type="integer", nullable=false)
     */
    private $idGenero;

    /**
     * @var int
     *
     * @ORM\Column(name="NUMERO_DOCUMENTO", type="integer", nullable=false)
     */
    private $numeroDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="E_MAIL", type="string", length=45, nullable=false)
     */
    private $eMail;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_CIUDAD", type="integer", nullable=false)
     */
    private $idCiudad;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_PAIS", type="integer", nullable=false)
     */
    private $idPais;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_TIPO_DOC", type="integer", nullable=false)
     */
    private $idTipoDoc;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTRASEÑA", type="string", length=45, nullable=false)
     */
    private $contraseÑa;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_TIPO_USUARIO", type="integer", nullable=false)
     */
    private $idTipoUsuario;


    /**
     * @var int
     *
     * @ORM\Column(name="token_cel", type="string", length=150, nullable=true)
     */
    private $tokenCel;

    public function getTokenCel(): ?string
    {
        return $this->tokenCel;
    }

    public function setTokenCel(string $tokenCel): self
    {
        $this->tokenCel = $tokenCel;

        return $this;
    }

    public function getIdUsuario(): ?int
    {
        return $this->idUsuario;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(\DateTimeInterface $fechaNacimiento): self
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getIdGenero(): ?int
    {
        return $this->idGenero;
    }

    public function setIdGenero(int $idGenero): self
    {
        $this->idGenero = $idGenero;

        return $this;
    }

    public function getNumeroDocumento(): ?int
    {
        return $this->numeroDocumento;
    }

    public function setNumeroDocumento(int $numeroDocumento): self
    {
        $this->numeroDocumento = $numeroDocumento;

        return $this;
    }

    public function getEMail(): ?string
    {
        return $this->eMail;
    }

    public function setEMail(string $eMail): self
    {
        $this->eMail = $eMail;

        return $this;
    }

    public function getIdCiudad(): ?int
    {
        return $this->idCiudad;
    }

    public function setIdCiudad(int $idCiudad): self
    {
        $this->idCiudad = $idCiudad;

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

    public function getIdTipoDoc(): ?int
    {
        return $this->idTipoDoc;
    }

    public function setIdTipoDoc(int $idTipoDoc): self
    {
        $this->idTipoDoc = $idTipoDoc;

        return $this;
    }

    public function getContraseÑa(): ?string
    {
        return $this->contraseÑa;
    }

    public function setContraseÑa(string $contraseÑa): self
    {
        $this->contraseÑa = $contraseÑa;

        return $this;
    }

    public function getIdTipoUsuario(): ?int
    {
        return $this->idTipoUsuario;
    }

    public function setIdTipoUsuario(int $idTipoUsuario): self
    {
        $this->idTipoUsuario = $idTipoUsuario;

        return $this;
    }


}
