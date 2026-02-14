<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** Controlador para mostrar la portada informativa del proyecto. */
class HomeController extends AbstractController
{
    /**
     * Ruta pública principal.
     * Explica al alumno qué es BookMarket y qué funcionalidades tiene.
     */
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }
}
