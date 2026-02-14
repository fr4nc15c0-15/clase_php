<?php

namespace App\Entity;

use App\Repository\PedidoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** Entidad que representa una compra/pedido realizado por un usuario. */
#[ORM\Entity(repositoryClass: PedidoRepository::class)]
#[ORM\Table(name: 'pedido')]
class Pedido
{
    /** ID interno del pedido. */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /** Fecha y hora de creación del pedido. */
    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $fecha;

    /** Importe total del pedido en euros. */
    #[ORM\Column(type: 'float')]
    #[Assert\Positive(message: 'El total debe ser positivo.')]
    private ?float $total = null;

    /** Estado básico del pedido (pendiente, pagado, enviado...). */
    #[ORM\Column(length: 40)]
    #[Assert\NotBlank(message: 'El estado del pedido es obligatorio.')]
    private ?string $estado = 'pendiente';

    /** Usuario al que pertenece el pedido (relación obligatoria). */
    #[ORM\ManyToOne(inversedBy: 'pedidos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuario = null;

    /** Constructor con fecha actual automática. */
    public function __construct() { $this->fecha = new \DateTimeImmutable(); }

    /** Devuelve id. */
    public function getId(): ?int { return $this->id; }
    /** Devuelve fecha. */
    public function getFecha(): \DateTimeImmutable { return $this->fecha; }
    /** Asigna fecha. */
    public function setFecha(\DateTimeImmutable $fecha): self { $this->fecha = $fecha; return $this; }
    /** Devuelve total. */
    public function getTotal(): ?float { return $this->total; }
    /** Asigna total. */
    public function setTotal(float $total): self { $this->total = $total; return $this; }
    /** Devuelve estado. */
    public function getEstado(): ?string { return $this->estado; }
    /** Asigna estado. */
    public function setEstado(string $estado): self { $this->estado = $estado; return $this; }
    /** Devuelve usuario propietario. */
    public function getUsuario(): ?Usuario { return $this->usuario; }
    /** Asigna usuario propietario. */
    public function setUsuario(?Usuario $usuario): self { $this->usuario = $usuario; return $this; }
}
