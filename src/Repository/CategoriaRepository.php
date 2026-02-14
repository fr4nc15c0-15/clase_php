<?php

namespace App\Repository;

use App\Entity\Categoria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/** Repositorio de Categoria con posibilidad de consultas personalizadas. */
class CategoriaRepository extends ServiceEntityRepository
{
    /** Constructor enlazado a la entidad Categoria. */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categoria::class);
    }
}
