<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SecurityController
 * @package AppBundle\Controller
 */
class SecurityController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request)
    {
        $helper = $this->get('security.authentication_utils');

        return $this->render(
            '@App/security/login.html.twig',
            array(
                'last_username' => $helper->getLastUsername(),
                'error'         => $helper->getLastAuthenticationError(),
            )
        );
    }
}