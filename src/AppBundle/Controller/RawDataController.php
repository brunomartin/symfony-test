<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\RawData;
use AppBundle\Form\RawDataType;

use AppBundle\Service\FileUploader;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RawDataController extends Controller
{
    /**
     * @Route("/rawdata_add", name="rawdata_add")
     */
    public function addAction(Request $request, FileUploader $fileUploader)
    {
        $rawData = new RawData();
        $form = $this->createForm(RawDataType::class, $rawData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          // throw new NotFoundHttpException("No User at this point");
          $rawData = $form->getData();
          $file = $rawData->getFileName();
          $rawData->setFileSize($rawData->getFileSize());

          $fileName = $fileUploader->upload("test", $file);

          $rawData->setFileName($fileName);

          $em = $this->getDoctrine()->getManager();
          $em->persist($rawData);
          $em->flush();


          return $this->redirectToRoute('homepage');
        }

        return $this->render('AppBundle:RawData:rawdata_add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
