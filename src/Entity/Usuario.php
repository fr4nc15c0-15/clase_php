<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Esta entidad representa a los usuarios que pueden iniciar sesión en BookMarket.
 */
#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
#[ORM\Table(name: 'usuario')]
#[UniqueEntity(fields: ['email'], message: 'Este email ya está registrado.')]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    /** Identificador único autoincremental del usuario. */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /** Nombre visible del usuario. */
    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: 'El nombre es obligatorio.')]
    private ?string $nombre = null;

    /** Email único usado para autenticación. */
    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank(message: 'El email es obligatorio.')]
    #[Assert\Email(message: 'Debes escribir un email válido.')]
    private ?string $email = null;

    /** Contraseña hasheada con el algoritmo seguro de Symfony. */
    #[ORM\Column]
    #[Assert\NotBlank(message: 'La contraseña es obligatoria.')]
    private ?string $password = null;

    /** Rol principal del usuario; por simplicidad guardamos uno solo. */
    #[ORM\Column(length: 30)]
    #[Assert\NotBlank(message: 'El rol es obligatorio.')]
    private string $rol = 'ROLE_USER';

    /** Fecha en la que se registró la cuenta. */
    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $fechaRegistro;

    /** Colección de libros publicados por este usuario. */
    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Libro::class, orphanRemoval: true)]
    private Collection $libros;

    /** Colección de pedidos realizados por este usuario. */
    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Pedido::class, orphanRemoval: true)]
    private Collection $pedidos;

    /** Constructor para inicializar colecciones y fecha por defecto. */
    public function __construct()
    {
        $this->libros = new ArrayCollection();
        $this->pedidos = new ArrayCollection();
        $this->fechaRegistro = new \DateTimeImmutable();
    }

    /** Devuelve el id del usuario. */
    public function getId(): ?int { return $this->id; }

    /** Devuelve el nombre del usuario. */
    public function getNombre(): ?string { return $this->nombre; }

    /** Asigna el nombre del usuario. */
    public function setNombre(string $nombre): self { $this->nombre = $nombre; return $this; }

    /** Devuelve el email del usuario. */
    public function getEmail(): ?string { return $this->email; }

    /** Asigna el email del usuario. */
    public function setEmail(string $email): self { $this->email = strtolower($email); return $this; }

    /**
     * Identificador visual del usuario para Security.
     */
    public function getUserIdentifier(): string { return (string) $this->email; }

    /** Devuelve la contraseña hasheada. */
    public function getPassword(): ?string { return $this->password; }

    /** Asigna la contraseña hasheada. */
    public function setPassword(string $password): self { $this->password = $password; return $this; }

    /**
     * Symfony trabaja con un array de roles; transformamos el campo simple.
     */
    public function getRoles(): array { return [$this->rol]; }

    /** Permite cambiar el rol principal. */
    public function setRol(string $rol): self { $this->rol = $rol; return $this; }

    /** Devuelve el rol principal como texto. */
    public function getRol(): string { return $this->rol; }

    /** No almacenamos credenciales temporales, así que queda vacío. */
    public function eraseCredentials(): void {}

    /** Devuelve la fecha de registro. */
    public function getFechaRegistro(): \DateTimeImmutable { return $this->fechaRegistro; }

    /** Asigna manualmente una fecha de registro. */
    public function setFechaRegistro(\DateTimeImmutable $fechaRegistro): self { $this->fechaRegistro = $fechaRegistro; return $this; }

    /** Devuelve la colección de libros del usuario. */
    public function getLibros(): Collection { return $this->libros; }

    /** Añade un libro y sincroniza la relación inversa. */
    public function addLibro(Libro $libro): self
    {
        if (!$this->libros->contains($libro)) {
            $this->libros->add($libro);
            $libro->setUsuario($this);
        }
        return $this;
    }

    /** Elimina un libro y limpia la relación inversa. */
    public function removeLibro(Libro $libro): self
    {
        if ($this->libros->removeElement($libro) && $libro->getUsuario() === $this) {
            $libro->setUsuario(null);
        }
        return $this;
    }

    /** Devuelve la colección de pedidos del usuario. */
    public function getPedidos(): Collection { return $this->pedidos; }

    /** Añade un pedido y sincroniza su usuario propietario. */
    public function addPedido(Pedido $pedido): self
    {
        if (!$this->pedidos->contains($pedido)) {
            $this->pedidos->add($pedido);
            $pedido->setUsuario($this);
        }
        return $this;
    }

    /** Elimina un pedido y limpia la relación inversa. */
    public function removePedido(Pedido $pedido): self
    {
        if ($this->pedidos->removeElement($pedido) && $pedido->getUsuario() === $this) {
            $pedido->setUsuario(null);
        }
        return $this;
    }
}
