<?php

namespace AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;

class UserProfile
{
    private $id;
    private $avatar;
    private $cover;
    private $facebook;
    private $twitter;
    private $website;
    private $biographie;
    private $favoriteBook;
    private $inspiration;
    private $style;
    private $experience;
    private $createdAt;
    private $updatedAt;
    private $avatarFile;
    private $user;
    private $favoriteAuthors;
    private $favoriteGenre;

    public function __toString()
    {
        return 'Profil utilisateur';
    }

    public function getId()
    {
        return $this->id;
    }

    public function setAvatarFile(File $image = null)
    {
        $this->avatarFile = $image;
        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime();
        }

        return $this;
    }

    public function getAvatarFile()
    {
        return $this->avatarFile;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    public function getCover()
    {
        return $this->cover;
    }

    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getFacebook()
    {
        return $this->facebook;
    }

    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getTwitter()
    {
        return $this->twitter;
    }

    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function setBiographie($biographie)
    {
        $this->biographie = $biographie;

        return $this;
    }

    public function getBiographie()
    {
        return $this->biographie;
    }

    public function setFavoriteBook($favoriteBook)
    {
        $this->favoriteBook = $favoriteBook;

        return $this;
    }

    public function getFavoriteBook()
    {
        return $this->favoriteBook;
    }

    public function setInspiration($inspiration)
    {
        $this->inspiration = $inspiration;

        return $this;
    }

    public function getInspiration()
    {
        return $this->inspiration;
    }

    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    public function getStyle()
    {
        return $this->style;
    }

    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    public function getExperience()
    {
        return $this->experience;
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

    public function isFilled()
    {
        if ($this->experience || $this->inspiration || $this->style || $this->favoriteBook || $this->favoriteAuthors || $this->favoriteGenre)
            return true;

        return false;
    }

    public function setFavoriteAuthors($favoriteAuthors)
    {
        $this->favoriteAuthors = $favoriteAuthors;

        return $this;
    }

    public function getFavoriteAuthors()
    {
        return $this->favoriteAuthors;
    }

    public function setFavoriteGenre($favoriteGenre)
    {
        $this->favoriteGenre = $favoriteGenre;

        return $this;
    }

    public function getFavoriteGenre()
    {
        return $this->favoriteGenre;
    }
}
