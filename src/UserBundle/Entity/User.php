<?php

/**
 * Created by PhpStorm.
 * User: maxta
 * Date: 22/06/2016
 * Time: 20:58
 */

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\Network",mappedBy="user",cascade={"remove"})
     * @var
     */
    private $networks;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Add network
     *
     * @param \UserBundle\Entity\Network $network
     *
     * @return User
     */
    public function addNetwork(\UserBundle\Entity\Network $network)
    {
        $this->networks[] = $network;

        return $this;
    }

    /**
     * Remove network
     *
     * @param \UserBundle\Entity\Network $network
     */
    public function removeNetwork(\UserBundle\Entity\Network $network)
    {
        $this->networks->removeElement($network);
    }

    /**
     * Get networks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNetworks()
    {
        return $this->networks;
    }
}
