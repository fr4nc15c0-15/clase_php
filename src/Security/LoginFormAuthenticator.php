<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

/**
 * Autenticador de formulario para login clásico email+password.
 */
class LoginFormAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    /** Nombre de ruta del formulario de login. */
    public const LOGIN_ROUTE = 'app_login';

    /** Inyectamos generador de URLs para redirecciones. */
    public function __construct(private UrlGeneratorInterface $urlGenerator) {}

    /**
     * Extrae credenciales del POST y construye el Passport.
     */
    public function authenticate(Request $request): Passport
    {
        $email = (string) $request->request->get('email', '');
        $request->getSession()->set('_security.last_username', $email);

        return new Passport(
            new UserBadge($email),
            new PasswordCredentials((string) $request->request->get('password', '')),
            [
                new CsrfTokenBadge('authenticate', (string) $request->request->get('_csrf_token')),
                new RememberMeBadge(),
            ]
        );
    }

    /**
     * Tras login correcto, redirige a la última ruta privada o al listado de libros.
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?RedirectResponse
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        return new RedirectResponse($this->urlGenerator->generate('app_libro_index'));
    }

    /** Devuelve la URL del formulario de login. */
    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
