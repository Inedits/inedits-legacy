<?php

namespace AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;

/**
 * UserProfile
 */
class UserProfile
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $avatar;

    /**
     * @var string
     */
    private $cover;

    /**
     * @var string
     */
    private $facebook;

    /**
     * @var string
     */
    private $twitter;

    /**
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $biographie;

    /**
     * @var string
     */
    private $favoriteBook;

    /**
     * @var string
     */
    private $inspiration;

    /**
     * @var string
     */
    private $style;

    /**
     * @var string
     */
    private $experience;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     *
     *
     * @var File
     */
    private $avatarFile;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Product
     */
    public function setAvatarFile(File $image = null)
    {
        $this->avatarFile = $image;
        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updated_at = new \DateTime();
        }

        return $this;
    }


    /**
     * @return File
     */
    public function getAvatarFile()
    {
        return $this->avatarFile;
    }


    public function __toString()
    {
        return 'Profil utilisateur';
    }

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
     * Set avatar
     *
     * @param string $avatar
     *
     * @return UserProfile
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set cover
     *
     * @param string $cover
     *
     * @return UserProfile
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return UserProfile
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     *
     * @return UserProfile
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return UserProfile
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set biographie
     *
     * @param string $biographie
     *
     * @return UserProfile
     */
    public function setBiographie($biographie)
    {
        $this->biographie = $biographie;

        return $this;
    }

    /**
     * Get biographie
     *
     * @return string
     */
    public function getBiographie()
    {
        return $this->biographie;
    }

    /**
     * Set favoriteBook
     *
     * @param string $favoriteBook
     *
     * @return UserProfile
     */
    public function setFavoriteBook($favoriteBook)
    {
        $this->favoriteBook = $favoriteBook;

        return $this;
    }

    /**
     * Get favoriteBook
     *
     * @return string
     */
    public function getFavoriteBook()
    {
        return $this->favoriteBook;
    }

    /**
     * Set inspiration
     *
     * @param string $inspiration
     *
     * @return UserProfile
     */
    public function setInspiration($inspiration)
    {
        $this->inspiration = $inspiration;

        return $this;
    }

    /**
     * Get inspiration
     *
     * @return string
     */
    public function getInspiration()
    {
        return $this->inspiration;
    }

    /**
     * Set style
     *
     * @param string $style
     *
     * @return UserProfile
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get style
     *
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set experience
     *
     * @param string $experience
     *
     * @return UserProfile
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return string
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @var integer
     */
    private $userId;
    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return UserProfile
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @var \AppBundle\Entity\User
     */
    private $user;

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UserProfile
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return UserProfile
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
     * @return UserProfile
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

    public function isFilled()
    {
        if ($this->experience || $this->inspiration || $this->style || $this->favoriteBook || $this->favoriteAuthors || $this->favoriteGenre)
            return true;

        return false;
    }
    /**
     * @var string
     */
    private $favoriteAuthors;

    /**
     * @var string
     */
    private $favoriteGenre;


    /**
     * Set favoriteAuthors
     *
     * @param string $favoriteAuthors
     *
     * @return UserProfile
     */
    public function setFavoriteAuthors($favoriteAuthors)
    {
        $this->favoriteAuthors = $favoriteAuthors;

        return $this;
    }

    /**
     * Get favoriteAuthors
     *
     * @return string
     */
    public function getFavoriteAuthors()
    {
        return $this->favoriteAuthors;
    }

    /**
     * Set favoriteGenre
     *
     * @param string $favoriteGenre
     *
     * @return UserProfile
     */
    public function setFavoriteGenre($favoriteGenre)
    {
        $this->favoriteGenre = $favoriteGenre;

        return $this;
    }

    /**
     * Get favoriteGenre
     *
     * @return string
     */
    public function getFavoriteGenre()
    {
        return $this->favoriteGenre;
    }
}
