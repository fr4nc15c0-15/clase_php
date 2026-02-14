<?php

namespace App\Entity;

use App\Repository\MensajeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** Entidad simple para almacenar mensajes de contacto o feedback. */
#[ORM\Entity(repositoryClass: MensajeRepository::class)]
#[ORM\Table(name: 'mensaje')]
class Mensaje
{
    /** ID interno del mensaje. */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /** Contenido textual del mensaje. */
    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: 'El contenido no puede estar vacío.')]
    private ?string $contenido = null;

    /** Fecha y hora en la que se creó el mensaje. */
    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $fecha;

    /** Constructor con fecha automática actual. */
    public function __construct() { $this->fecha = new \DateTimeImmutable(); }

    /** Devuelve el id. */
    public function getId(): ?int { return $this->id; }
    /** Devuelve el contenido. */
    public function getContenido(): ?string { return $this->contenido; }
    /** Asigna el contenido. */
    public function setContenido(string $contenido): self { $this->contenido = $contenido; return $this; }
    /** Devuelve la fecha. */
    public function getFecha(): \DateTimeImmutable { return $this->fecha; }
    /** Asigna la fecha. */
    public function setFecha(\DateTimeImmutable $fecha): self { $this->fecha = $fecha; return $this; }
}
