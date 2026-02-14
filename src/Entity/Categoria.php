<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** Entidad que clasifica libros por temática o género. */
#[ORM\Entity(repositoryClass: CategoriaRepository::class)]
#[ORM\Table(name: 'categoria')]
class Categoria
{
    /** ID interno de la categoría. */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /** Nombre de la categoría (ejemplo: Novela, Tecnología). */
    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: 'El nombre de la categoría es obligatorio.')]
    private ?string $nombre = null;

    /** Explicación corta de qué agrupa esta categoría. */
    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $descripcion = null;

    /** Relación inversa: una categoría contiene muchos libros. */
    #[ORM\OneToMany(mappedBy: 'categoria', targetEntity: Libro::class)]
    private Collection $libros;

    /** Constructor para inicializar la colección de libros. */
    public function __construct() { $this->libros = new ArrayCollection(); }

    /** Devuelve el id de la categoría. */
    public function getId(): ?int { return $this->id; }

    /** Devuelve el nombre de la categoría. */
    public function getNombre(): ?string { return $this->nombre; }

    /** Asigna el nombre de la categoría. */
    public function setNombre(string $nombre): self { $this->nombre = $nombre; return $this; }

    /** Devuelve la descripción. */
    public function getDescripcion(): ?string { return $this->descripcion; }

    /** Asigna la descripción. */
    public function setDescripcion(?string $descripcion): self { $this->descripcion = $descripcion; return $this; }

    /** Devuelve libros asociados. */
    public function getLibros(): Collection { return $this->libros; }

    /** Texto legible en selects de formularios. */
    public function __toString(): string { return (string) $this->nombre; }
}
