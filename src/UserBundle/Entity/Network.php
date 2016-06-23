<?php

namespace UserBundle\Entity;

use Abraham\TwitterOAuth\TwitterOAuth;
use Doctrine\ORM\Mapping as ORM;

/**
 * Network
 *
 * @ORM\Table(name="network")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\NetworkRepository")
 */
class Network
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="network_user_id", type="string", length=255, unique=true)
     */
    private $networkUserId;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User",inversedBy="networks")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="access_token", type="string", length=255)
     */
    private $access_token;

    /**
     * @var string
     *
     * @ORM\Column(name="access_token_secret", type="string", length=255)
     */
    private $access_token_secret;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Network
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
     * Set type
     *
     * @param string $type
     *
     * @return Network
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Network
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set accessToken
     *
     * @param string $accessToken
     *
     * @return Network
     */
    public function setAccessToken($accessToken)
    {
        $this->access_token = $accessToken;

        return $this;
    }

    /**
     * Get accessToken
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * Set accessTokenSecret
     *
     * @param string $accessTokenSecret
     *
     * @return Network
     */
    public function setAccessTokenSecret($accessTokenSecret)
    {
        $this->access_token_secret = $accessTokenSecret;

        return $this;
    }

    /**
     * Get accessTokenSecret
     *
     * @return string
     */
    public function getAccessTokenSecret()
    {
        return $this->access_token_secret;
    }


    /**
     * Set networkUserId
     *
     * @param string $networkUserId
     *
     * @return Network
     */
    public function setNetworkUserId($networkUserId)
    {
        $this->networkUserId = $networkUserId;

        return $this;
    }

    /**
     * Get networkUserId
     *
     * @return string
     */
    public function getNetworkUserId()
    {
        return $this->networkUserId;
    }

    public function getConnection($consumerKey,$consumerSecret)
    {
        $connection = new TwitterOAuth($consumerKey,$consumerSecret,$this->getAccessToken(),$this->getAccessTokenSecret());
        return $connection;
    }
}
