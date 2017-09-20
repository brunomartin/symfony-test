<?php
//AppBundle\Listener\LogoutListener.php

namespace AppBundle\Listener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Doctrine\ORM\EntityManagerInterface;

class LogoutListener implements LogoutHandlerInterface
{

    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @{inheritDoc}
     */
    public function logout(Request $request, Response $response, TokenInterface $token)
    {
      $user = $token->getUser();

      // throw new NotFoundHttpException("Page not found");

      // $em = $this->getDoctrine()->getManager();
      $user->setIsActive(false);
      $this->em->persist($user);
      $this->em->flush();
    }
}
