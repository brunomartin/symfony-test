<?php

// src/AppBundle/Entity/User.php
namespace AppBundle\Entity;

use AppBundle\DBAL\Types\UserRoleType;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="RawData", mappedBy= "user")
     * @var RawDatas[] An ArrayCollection of RawData objects.
     **/
    private $rawDatas = null;

    public function __construct()
    {
      parent::__construct();
    }

    /**
     * Add rawData
     *
     * @param \AppBundle\Entity\RawData $rawData
     *
     * @return User
     */
    public function addRawData(\AppBundle\Entity\RawData $rawData)
    {
        $this->rawDatas[] = $rawData;

        return $this;
    }

    /**
     * Remove rawData
     *
     * @param \AppBundle\Entity\RawData $rawData
     */
    public function removeRawData(\AppBundle\Entity\RawData $rawData)
    {
        $this->rawDatas->removeElement($rawData);
    }

    /**
     * Get rawDatas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRawDatas()
    {
        return $this->rawDatas;
    }
}
