<?php
namespace AppBundle\Security\Handler;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use \Firebase\JWT\JWT;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Symfony\Component\Security\Http\HttpUtils;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

class SecurityHandler implements AuthenticationSuccessHandlerInterface
{
    private $secretKey;
    private $router;
    private $httpUtils;

    /**
     * SecurityHandler constructor.
     * @param HttpUtils $httpUtils
     * @param Router $router
     * @param $secretKey
     */
    function __construct(HttpUtils $httpUtils, Router $router, $secretKey)
    {
        $this->secretKey = $secretKey;
        $this->router = $router;
        $this->httpUtils = $httpUtils;
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     *
     * @return Response
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $response = new RedirectResponse($this->router->generate('employee_index'));
        $jwtToken = JWT::encode(['username' => $token->getUsername()], $this->secretKey);
        $response->headers->setCookie(new Cookie('jwt', $jwtToken));
        return $response;
    }
}

