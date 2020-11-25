<?php


namespace App\Dto;


use Symfony\Component\Validator\Constraints as Assert;

class NotesDto
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     */
    private $title;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     */
    private $content;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return NotesDto
     */
    public function setTitle(string $title): NotesDto
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return NotesDto
     */
    public function setContent(string $content): NotesDto
    {
        $this->content = $content;
        return $this;
    }
}
