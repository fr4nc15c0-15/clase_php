<?php

namespace App\Entity;

use App\Repository\LibroRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** Entidad principal de negocio: representa un libro publicado en el sistema. */
#[ORM\Entity(repositoryClass: LibroRepository::class)]
#[ORM\Table(name: 'libro')]
class Libro
{
    /** ID único del libro. */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /** Título del libro. */
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'El título es obligatorio.')]
    private ?string $titulo = null;

    /** Autor principal del libro. */
    #[ORM\Column(length: 150)]
    #[Assert\NotBlank(message: 'El autor es obligatorio.')]
    private ?string $autor = null;

    /** Descripción breve del contenido o estado del libro. */
    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: 'La descripción es obligatoria.')]
    private ?string $descripcion = null;

    /** Precio del libro en euros. */
    #[ORM\Column(type: 'float')]
    #[Assert\Positive(message: 'El precio debe ser positivo.')]
    private ?float $precio = null;

    /** Estado simple del libro (disponible, reservado, vendido). */
    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: 'El estado es obligatorio.')]
    private ?string $estado = 'disponible';

    /** Fecha de publicación/alta del libro. */
    #[ORM\Column(type: 'date_immutable')]
    private \DateTimeImmutable $fechaPublicacion;

    /** Relación obligatoria: cada libro pertenece a una categoría. */
    #[ORM\ManyToOne(inversedBy: 'libros')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categoria $categoria = null;

    /** Relación opcional con el usuario dueño/publicador del libro. */
    #[ORM\ManyToOne(inversedBy: 'libros')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Usuario $usuario = null;

    /** Constructor con fecha actual por defecto para simplificar el alta. */
    public function __construct() { $this->fechaPublicacion = new \DateTimeImmutable(); }

    /** Devuelve id. */
    public function getId(): ?int { return $this->id; }
    /** Devuelve título. */
    public function getTitulo(): ?string { return $this->titulo; }
    /** Asigna título. */
    public function setTitulo(string $titulo): self { $this->titulo = $titulo; return $this; }
    /** Devuelve autor. */
    public function getAutor(): ?string { return $this->autor; }
    /** Asigna autor. */
    public function setAutor(string $autor): self { $this->autor = $autor; return $this; }
    /** Devuelve descripción. */
    public function getDescripcion(): ?string { return $this->descripcion; }
    /** Asigna descripción. */
    public function setDescripcion(string $descripcion): self { $this->descripcion = $descripcion; return $this; }
    /** Devuelve precio. */
    public function getPrecio(): ?float { return $this->precio; }
    /** Asigna precio. */
    public function setPrecio(float $precio): self { $this->precio = $precio; return $this; }
    /** Devuelve estado. */
    public function getEstado(): ?string { return $this->estado; }
    /** Asigna estado. */
    public function setEstado(string $estado): self { $this->estado = $estado; return $this; }
    /** Devuelve fecha de publicación. */
    public function getFechaPublicacion(): \DateTimeImmutable { return $this->fechaPublicacion; }
    /** Asigna fecha de publicación. */
    public function setFechaPublicacion(\DateTimeImmutable $fechaPublicacion): self { $this->fechaPublicacion = $fechaPublicacion; return $this; }
    /** Devuelve categoría. */
    public function getCategoria(): ?Categoria { return $this->categoria; }
    /** Asigna categoría. */
    public function setCategoria(?Categoria $categoria): self { $this->categoria = $categoria; return $this; }
    /** Devuelve usuario dueño/publicador. */
    public function getUsuario(): ?Usuario { return $this->usuario; }
    /** Asigna usuario dueño/publicador. */
    public function setUsuario(?Usuario $usuario): self { $this->usuario = $usuario; return $this; }
}
