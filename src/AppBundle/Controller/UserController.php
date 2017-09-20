<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use Doctrine\DBAL\Exception\DBALException;

class UserController extends Controller
{
    /**
     * @Route("/user_add", name="user_add")
     */
    public function addAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();

        $user = new User();

        $error = "test";

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          $user = $form->getData();

          $encoded = $encoder->encodePassword($user, $user->getPassword());
          $user->setPassword($encoded);

          try {
            $em->persist($user);
            $em->flush();
          } catch (\Exception $e) {
            return $this->redirectToRoute('user_add');
          }

          $fs = new FileSystem();
          $homeDir = $this->getParameter('user_data_path');
          $fs->mkdir($homeDir.'/'.$user->getUsername());

          return $this->redirectToRoute('homepage');
        }

        return $this->render('AppBundle:User:user_add.html.twig', array(
          'form' => $form->createView()
        ));
    }

    /**
     * @Route("/user_show", name="user_show")
     */
    public function showAction()
    {

        $users = $this->getDoctrine()
          ->getRepository(User::class)
          ->findAll();

        return $this->render('AppBundle:User:user_show.html.twig', array(
            'users' => $users
        ));
    }

}
