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
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @Vich\Uploadable
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
     * @ORM\Column(name="description",type="text")
     * @var
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\Language",cascade={"persist"})
     * @var
     */
    private $language;


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="user_image", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

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

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

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

    /**
     * Set description
     *
     * @param string $description
     *
     * @return User
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return User
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Add language
     *
     * @param \UserBundle\Entity\Language $language
     *
     * @return User
     */
    public function addLanguage(\UserBundle\Entity\Language $language)
    {
        $this->language[] = $language;

        return $this;
    }

    /**
     * Remove language
     *
     * @param \UserBundle\Entity\Language $language
     */
    public function removeLanguage(\UserBundle\Entity\Language $language)
    {
        $this->language->removeElement($language);
    }

    /**
     * Get language
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLanguage()
    {
        return $this->language;
    }

    public function setImageFile($image)
    {
        if (isset($image)) {
            $this->imageFile = $image;
            $this->updatedAt = new \DateTime('now');
            return $this;
        }

    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }
}
