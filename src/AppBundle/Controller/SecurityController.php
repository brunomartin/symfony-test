<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SecurityController extends Controller
{
    /**
    * @Route("/login_old", name="login_old")
    */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
       // get the login error if there is one
       $error = $authUtils->getLastAuthenticationError();

       // last username entered by the user
       $lastUsername = $authUtils->getLastUsername();

       return $this->render('security/login.html.twig', array(
           'last_username' => $lastUsername,
           'error'         => $error,
       ));
    }


    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
      throw new NotFoundHttpException("No User at this point");
      if($this->getUser()) {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $user->setIsActive(false);
        $em->persist($user);
        $em->flush();
      } else {
        throw new NotFoundHttpException("No User at this point");
      }
    }
}
