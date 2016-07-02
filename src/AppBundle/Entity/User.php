<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User extends BaseUser
{
    public function __toString()
    {
        return $this->username;
    }

    /**
     * @var int
     */
    protected $id;


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
     * Get expiresAt
     *
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Get credentials_expire_at
     *
     * @return \DateTime
     */
    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }
    /**
     * @var \AppBundle\Entity\UserProfile
     */
    private $user_profile;


    /**
     * Set userProfile
     *
     * @param \AppBundle\Entity\UserProfile $userProfile
     *
     * @return User
     */
    public function setUserProfile(\AppBundle\Entity\UserProfile $userProfile = null)
    {
        $this->user_profile = $userProfile;

        return $this;
    }

    /**
     * Get userProfile
     *
     * @return \AppBundle\Entity\UserProfile
     */
    public function getUserProfile()
    {
        return $this->user_profile;
    }
}
