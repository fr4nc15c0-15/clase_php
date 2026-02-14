<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/** Controlador para autenticación (login/logout). */
class SecurityController extends AbstractController
{
    /**
     * Muestra formulario de login y errores de acceso si existen.
     */
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    /**
     * Symfony intercepta esta ruta automáticamente según security.yaml.
     */
    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('Esta acción está vacía a propósito: Symfony gestiona el logout.');
    }
}
