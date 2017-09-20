<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Entity\Employee;
use AppBundle\Form\EmployeeType;
use Symfony\Component\Form\BirthdayType;
use Symfony\Component\HttpFoundation\Request;

class EmployeeController extends Controller
{
    /**
     * @Route("/employee_add", name="employee_add")
     */
    public function addAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $employee = new Employee();

      $form = $this->createForm(EmployeeType::class, $employee);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $employee = $form->getData();
        $em->persist($employee);
        $em->flush();
        return $this->redirectToRoute('employee_list');
      }

      return $this->render('AppBundle:Employee:employee_add.html.twig', array(
        'form' => $form->createView(),
      ));

        return $this->render('AppBundle:Employee:employee_add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/employee_list", name="employee_list")
     */
    public function listAction(Request $request)
    {

      $employees = $this->getDoctrine()
        ->getRepository(Employee::class)
        ->findAll();

      return $this->render('AppBundle:Employee:employee_list.html.twig', array(
        'employees' => $employees,
      ));
    }

}
