<?php

namespace App\Repository;

use App\Entity\Valoracion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/** Repositorio de Valoracion con posibilidad de consultas personalizadas. */
class ValoracionRepository extends ServiceEntityRepository
{
    /** Constructor enlazado a la entidad Valoracion. */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Valoracion::class);
    }
}
