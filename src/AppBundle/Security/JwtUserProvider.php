<?php
namespace AppBundle\Security;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Firebase\JWT\JWT;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class JwtUserProvider implements UserProviderInterface
{
    private $doctrine;
    private $secretKey;

    /**
     * JwtUserProvider constructor.
     * @param Registry $doctrine
     * @param $secretKey
     */
    function __construct(Registry $doctrine, $secretKey)
    {
        $this->doctrine = $doctrine;
        $this->secretKey = $secretKey;
    }

    /**
     * @param $jwt
     */
    public function getUsernameForJwt($jwt)
    {
        $tokenDecoded = JWT::decode($jwt, $this->secretKey, array('HS256'));
        if(!isset($tokenDecoded->username)) {
            return;
        }
        return $tokenDecoded->username;
    }

    /**
     * @param string $username
     * @return \AppBundle\Entity\User|null|object
     */
    public function loadUserByUsername($username)
    {
        $user = $this->doctrine->getRepository('AppBundle:User')->findOneBy(['username' => $username]);
        return $user;
    }

    /**
     * @param UserInterface $user
     */
    public function refreshUser(UserInterface $user)
    {
        throw new UnsupportedUserException();
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return User::class === $class;
    }
}