<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

class User extends BaseUser
{
    protected $id;
    private $firstName;
    private $lastName;
    private $userProfile;
    private $posts;
    private $slug;
    private $createdAt;
    private $updatedAt;

    public function __toString()
    {
        return $this->lastName;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setEmail($email){
        parent::setEmail($email);
        $this->setUsername($email); // User email as username
    }

    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }

    public function setUserProfile(\AppBundle\Entity\UserProfile $userProfile = null)
    {
        $this->user_profile = $userProfile;
        $userProfile->setUser($this);

        return $this;
    }

    public function getUserProfile()
    {
        return $this->user_profile;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function addPost(\AppBundle\Entity\Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    public function removePost(\AppBundle\Entity\Post $post)
    {
        $this->posts->removeElement($post);
    }

    public function getPosts()
    {
        return $this->posts;
    }


    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return User
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    protected $gtu;


    /**
     * Get gtu
     *
     * @return boolean
     */
    public function getGtu()
    {
        return $this->gtu;
    }

    /**
     * Set updatedAt
     *
     * @param \Boolean $gtu
     *
     * @return User
     */
    public function setGtu($gtu)
    {
        $this->gtu = $gtu;

        return $this;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $trees;


    /**
     * Add tree
     *
     * @param \AppBundle\Entity\Post $tree
     *
     * @return User
     */
    public function addTree(\AppBundle\Entity\Post $tree)
    {
        $this->trees[] = $tree;

        return $this;
    }

    /**
     * Remove tree
     *
     * @param \AppBundle\Entity\Post $tree
     */
    public function removeTree(\AppBundle\Entity\Post $tree)
    {
        $this->trees->removeElement($tree);
    }

    /**
     * Get trees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrees()
    {
        return $this->trees;
    }

    private $createdAt;


    private $updatedAt;

    /**
     * @var \AppBundle\Entity\UserProfile
     */
    private $userProfile;


}
