<?php

namespace App\Repository;

use App\Entity\Pedido;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/** Repositorio de Pedido con posibilidad de consultas personalizadas. */
class PedidoRepository extends ServiceEntityRepository
{
    /** Constructor enlazado a la entidad Pedido. */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pedido::class);
    }
}
