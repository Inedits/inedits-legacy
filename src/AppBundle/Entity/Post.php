<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\File\File;

class Post
{
    private $id;
    private $title;
    private $content;
    private $isMain = 0;
    private $isEnd = 0;
    private $gtu;
    private $file;
    private $user;
    private $lft;
    private $rgt;
    private $root;
    private $lvl;
    private $children;
    private $parent;
    private $ancestor;
    private $slug;
    private $createdAt;
    private $updatedAt;
    private $contentPlain;

    public function __construct(User $user)
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = $user;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setIsMain($isMain)
    {
        $this->isMain = $isMain;

        return $this;
    }

    public function getIsMain()
    {
        return $this->isMain;
    }

    public function setIsEnd($isEnd)
    {
        $this->isEnd = $isEnd;

        return $this;
    }

    public function getIsEnd()
    {
        return $this->isEnd;
    }

    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    public function getLft()
    {
        return $this->lft;
    }

    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    public function getRgt()
    {
        return $this->rgt;
    }

    public function setRoot($root)
    {
        $this->root = $root;

        return $this;
    }

    public function getRoot()
    {
        return $this->root;
    }

    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    public function getLvl()
    {
        return $this->lvl;
    }

    public function addChild(\AppBundle\Entity\Post $child)
    {
        $this->children[] = $child;

        return $this;
    }

    public function removeChild(\AppBundle\Entity\Post $child)
    {
        $this->children->removeElement($child);
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function setParent(\AppBundle\Entity\Post $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setAncestor($ancestor)
    {
        $this->ancestor = $ancestor;

        return $this;
    }

    public function getAncestor()
    {
        return $this->ancestor;
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

    private $users;

    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    public function getUsers()
    {
        return $this->users;
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

    public function setContentPlain($contentPlain)
    {
        $this->contentPlain = $contentPlain;

        return $this;
    }

    public function getContentPlain()
    {
        return $this->contentPlain;
    }
}
