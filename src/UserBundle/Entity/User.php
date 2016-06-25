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

    /**
     * @ORM\OneToMany(targetEntity="OfferBundle\Entity\Offer",mappedBy="user", cascade={"remove"})
     * @var
     */
    private $offers;

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

    /**
     * Add offer
     *
     * @param \OfferBundle\Entity\Offer $offer
     *
     * @return User
     */
    public function addOffer(\OfferBundle\Entity\Offer $offer)
    {
        $this->offers[] = $offer;

        return $this;
    }

    /**
     * Remove offer
     *
     * @param \OfferBundle\Entity\Offer $offer
     */
    public function removeOffer(\OfferBundle\Entity\Offer $offer)
    {
        $this->offers->removeElement($offer);
    }

    /**
     * Get offers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffers()
    {
        return $this->offers;
    }
}
