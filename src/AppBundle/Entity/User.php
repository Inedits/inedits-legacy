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
    private $trees;
    protected $gtu;

    public function __toString()
    {
        return $this->firstName.' '.$this->lastName;
    }

    public function getCommonName()
    {
        return $this->firstName.' '.$this->lastName;
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
        $this->userProfile = $userProfile;
        $userProfile->setUser($this);

        return $this;
    }

    public function getUserProfile()
    {
        return $this->userProfile;
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

    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


    public function getGtu()
    {
        return $this->gtu;
    }

    public function setGtu($gtu)
    {
        $this->gtu = $gtu;

        return $this;
    }

    public function addTree(\AppBundle\Entity\Post $tree)
    {
        $this->trees[] = $tree;

        return $this;
    }

    public function removeTree(\AppBundle\Entity\Post $tree)
    {
        $this->trees->removeElement($tree);
    }

    public function getTrees()
    {
        return $this->trees;
    }



}
