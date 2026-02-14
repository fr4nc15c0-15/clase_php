<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

/** Kernel principal de Symfony: arranca bundles y configuración. */
class Kernel extends BaseKernel
{
    use MicroKernelTrait;
}
