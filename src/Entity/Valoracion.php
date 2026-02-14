<?php

namespace App\Entity;

use App\Repository\ValoracionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** Entidad para guardar valoraciones de la plataforma o de libros. */
#[ORM\Entity(repositoryClass: ValoracionRepository::class)]
#[ORM\Table(name: 'valoracion')]
class Valoracion
{
    /** ID único de la valoración. */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /** Puntuación numérica entre 1 y 5. */
    #[ORM\Column]
    #[Assert\Positive(message: 'La puntuación debe ser positiva.')]
    #[Assert\LessThanOrEqual(value: 5, message: 'La puntuación máxima es 5.')]
    private ?int $puntuacion = null;

    /** Comentario textual opcional de la valoración. */
    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $comentario = null;

    /** Fecha de creación de la valoración. */
    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $fecha;

    /** Constructor con fecha por defecto. */
    public function __construct() { $this->fecha = new \DateTimeImmutable(); }

    /** Devuelve id. */
    public function getId(): ?int { return $this->id; }
    /** Devuelve puntuación. */
    public function getPuntuacion(): ?int { return $this->puntuacion; }
    /** Asigna puntuación. */
    public function setPuntuacion(int $puntuacion): self { $this->puntuacion = $puntuacion; return $this; }
    /** Devuelve comentario. */
    public function getComentario(): ?string { return $this->comentario; }
    /** Asigna comentario. */
    public function setComentario(?string $comentario): self { $this->comentario = $comentario; return $this; }
    /** Devuelve fecha. */
    public function getFecha(): \DateTimeImmutable { return $this->fecha; }
    /** Asigna fecha. */
    public function setFecha(\DateTimeImmutable $fecha): self { $this->fecha = $fecha; return $this; }
}
