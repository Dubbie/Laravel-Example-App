<?php

namespace App\DTO;

use Illuminate\Support\Str;

/**
 * Class PostDTO
 * @package App\DTO
 */
class PostDTO
{
    /** @var string */
    private $title;

    /** @var string */
    private $content;

    /** @var integer */
    private $authorId;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return PostDTO
     */
    public function setTitle($title)
    {
        $this->title = Str::title($title);
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return PostDTO
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @param int $authorId
     * @return PostDTO
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
        return $this;
    }
}