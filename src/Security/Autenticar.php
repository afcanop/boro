<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class Autenticar extends AbstractAuthenticator
{
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function supports(Request $request): ?bool
    {
        return $request->getPathInfo() ===  '/login' && $request->isMethod('POST');
    }

    public function authenticate(Request $request): Passport
    {
        $datosJson = json_encode([
            'usuario' => $request->request->get('_username'),
            'clave' => $request->request->get('_password'),
            'tokenFirebase' => ''
        ]);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://143.110.216.145/rodio/public/index.php/api/usuario/autenticar');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datosJson);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($datosJson))
        );
        $respuesta = curl_exec($ch);
        curl_close($ch);

        $respuesta = json_decode($respuesta);
        if($respuesta->autenticar){
            $passport =  new SelfValidatingPassport(
                new UserBadge($respuesta->usuario->usuario),
            );
            return $passport;

        } else {
            throw new CustomUserMessageAuthenticationException('Error en la autenticación');
        }
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $request->getSession()->getFlashBag()->add('success', "You are now signed in. Greetings, commander.");
        return new RedirectResponse($this->urlGenerator->generate('inicio'));
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $data = [
            // you may want to customize or obfuscate the message first
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())

            // or to translate this message
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        ];
        $request->getSession()->getFlashBag()->add('success', $data['message']);
        return new RedirectResponse($this->urlGenerator->generate('app_login'));
    }

}