<?php

namespace App\Repository;

use App\Entity\Mensaje;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/** Repositorio de Mensaje con posibilidad de consultas personalizadas. */
class MensajeRepository extends ServiceEntityRepository
{
    /** Constructor enlazado a la entidad Mensaje. */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mensaje::class);
    }
}
