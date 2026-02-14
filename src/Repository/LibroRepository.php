<?php

namespace App\Repository;

use App\Entity\Libro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/** Repositorio de Libro con posibilidad de consultas personalizadas. */
class LibroRepository extends ServiceEntityRepository
{
    /** Constructor enlazado a la entidad Libro. */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Libro::class);
    }
}
