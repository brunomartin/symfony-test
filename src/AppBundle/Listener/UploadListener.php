<?php
//AppBundle\Listener\LogoutListener.php

namespace AppBundle\Listener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use AppBundle\Entity\User;
use AppBundle\Entity\RawData;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Oneup\UploaderBundle\Event\PostPersistEvent;

use FOS\UserBundle\Doctrine\UserManager;

use Doctrine\ORM\EntityManagerInterface;

class UploadListener
{

    protected $manager;
    protected $tokenStorage;
    protected $userManager;

    public function __construct(EntityManagerInterface $manager, TokenStorageInterface $tokenStorage, UserManager $userManager)
    {
        $this->manager = $manager;
        $this->tokenStorage = $tokenStorage;
        $this->userManager = $userManager;
    }

    /**
     * @{inheritDoc}
     */
    public function onUpload(PostPersistEvent $event)
    {

        $token = $this->tokenStorage->getToken();
        $file = $event->getFile();

        if(!is_object($token->getUser())) {
          throw new NotFoundHttpException("Not logged in !!!");
        } else {
          // throw new NotFoundHttpException("Logged in " . $user->getUsername());
        }

        $username = $token->getUser()->getUsername();
        $user = $this->userManager->findUserByUsername($username);

        // throw new NotFoundHttpException("Logged in " . $user->getUsername());

        // $file->move($this->getTargetDir().'/'.$userDir, $fileName);

        $rawData = new RawData();
        $rawData->setFileName($file->getPathName());
        $rawData->setUser($user);
        $rawData->setFileSize($file->getSize());
        $rawData->setUpdatedAt(new \DateTimeImmutable());

        $this->manager->persist($rawData);
        $this->manager->flush();
    }
}
