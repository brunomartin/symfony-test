<?php
//AppBundle\Listener\AuthenticationSuccessHandler.php

namespace AppBundle\Listener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\RouterInterface;

class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{

    protected $em;
    protected $router;

    public function __construct(EntityManagerInterface $em, RouterInterface $router)
    {
        $this->em = $em;
        $this->router = $router;
    }

    /**
     * @{inheritDoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
      $user = $token->getUser();

      $user->setIsActive(true);
      $this->em->persist($user);
      $this->em->flush();

      return new RedirectResponse($this->router->generate('homepage'));
    }
}
