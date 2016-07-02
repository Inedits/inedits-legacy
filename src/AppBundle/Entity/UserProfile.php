<?php

namespace AppBundle\Entity;

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
}
