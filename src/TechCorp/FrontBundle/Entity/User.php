<?php

namespace TechCorp\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use TechCorp\FrontBundle\Entity\Status;

/**
* @ORM\Entity
* @ORM\Table(name="user")
*/

class User //extends BaseUser
{

    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /**
    * @var string 
    *
    * @ORM\Column(name="username", type="string", length=255)
    */
    private $username;

    /**
    * @ORM\OneToMany(targetEntity="Status", mappedBy="user")
    */
    protected $statuses;

    public function __construct()
    {
        # code...
        //parent::__construct();
        $this->statuses = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Add statuses
     *
     * @param \TechCorp\FrontBundle\Entity\Status $statuses
     * @return User
     */
    public function addStatus(\TechCorp\FrontBundle\Entity\Status $statuses)
    {
        $this->statuses[] = $statuses;

        return $this;
    }

    /**
     * Remove statuses
     *
     * @param \TechCorp\FrontBundle\Entity\Status $statuses
     */
    public function removeStatus(\TechCorp\FrontBundle\Entity\Status $statuses)
    {
        $this->statuses->removeElement($statuses);
    }

    /**
     * Get statuses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStatuses()
    {
        return $this->statuses;
    }
}
