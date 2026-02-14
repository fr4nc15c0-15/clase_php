<?php

namespace App\Repository;

use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/** Repositorio de Usuario con posibilidad de consultas personalizadas. */
class UsuarioRepository extends ServiceEntityRepository
{
    /** Constructor enlazado a la entidad Usuario. */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuario::class);
    }
}
