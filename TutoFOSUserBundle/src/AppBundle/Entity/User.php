<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as FosUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends FosUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="facebook_id", type="string", length=255, nullable=true)
     */
    protected $facebook_id;

    /**
     * @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true)
     */
    protected $facebook_access_token;

    /**
     * @ORM\Column(name="google_id", type="string", length=255, nullable=true)
     */
    protected $google_id;

    /**
     * @ORM\Column(name="google_access_token", type="string", length=255, nullable=true)
     */
    protected $google_token;

    /**
     * @ORM\Column(name="twitter_id", type="string", length=255, nullable=true)
     */
    protected $twitter_id;

    /**
     * @ORM\Column(name="twitter_access_token", type="string", length=255, nullable=true)
     */
    protected $twitter_token;

    /**
     * @ORM\Column(name="img_profile", type="string", length=255, nullable=true)
     */
    protected $img_profile;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set facebookId
     *
     * @param string $facebookId
     *
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;

        return $this;
    }

    /**
     * Get facebookId
     *
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * Set facebookAccessToken
     *
     * @param string $facebookAccessToken
     *
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * Get facebookAccessToken
     *
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }

    /**
     * Set imgProfile
     *
     * @param string $imgProfile
     *
     * @return User
     */
    public function setImgProfile($imgProfile)
    {
        $this->img_profile = $imgProfile;

        return $this;
    }

    /**
     * Get imgProfile
     *
     * @return string
     */
    public function getImgProfile()
    {
        return $this->img_profile;
    }

    /**
     * Set googleId
     *
     * @param string $googleId
     *
     * @return User
     */
    public function setGoogleId($googleId)
    {
        $this->google_id = $googleId;

        return $this;
    }

    /**
     * Get googleId
     *
     * @return string
     */
    public function getGoogleId()
    {
        return $this->google_id;
    }

    /**
     * Set googleToken
     *
     * @param string $googleToken
     *
     * @return User
     */
    public function setGoogleAccessToken($googleToken)
    {
        $this->google_token = $googleToken;

        return $this;
    }

    /**
     * Get googleToken
     *
     * @return string
     */
    public function getGoogleAccessToken()
    {
        return $this->google_token;
    }

    /**
     * Set googleToken
     *
     * @param string $googleToken
     *
     * @return User
     */
    public function setGoogleToken($googleToken)
    {
        $this->google_token = $googleToken;

        return $this;
    }

    /**
     * Get googleToken
     *
     * @return string
     */
    public function getGoogleToken()
    {
        return $this->google_token;
    }

    /**
     * Set twitterId
     *
     * @param string $twitterId
     *
     * @return User
     */
    public function setTwitterId($twitterId)
    {
        $this->twitter_id = $twitterId;

        return $this;
    }

    /**
     * Get twitterId
     *
     * @return string
     */
    public function getTwitterId()
    {
        return $this->twitter_id;
    }

    /**
     * Set twitterToken
     *
     * @param string $twitterToken
     *
     * @return User
     */
    public function setTwitterAccessToken($twitterToken)
    {
        $this->twitter_token = $twitterToken;

        return $this;
    }

    /**
     * Get twitterToken
     *
     * @return string
     */
    public function getTwitterAccessToken()
    {
        return $this->twitter_token;
    }
}
