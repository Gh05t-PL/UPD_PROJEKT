<?php

namespace App\Document;

use App\Repository\NotesRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Note
 * @package App\Document
 * @MongoDB\Document(repositoryClass=NotesRepository::class, collection="Notes")
 */
class Notes
{
    /**
     * @var string
     * @MongoDB\Id(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     * @MongoDB\Field(type="string")
     */
    private $title;

    /**
     * @var string
     * @MongoDB\Field(type="string")
     */
    private $content;

    /**
     * @var \DateTime|null
     * @MongoDB\Field(type="date")
     */
    private $createdAt;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Notes
     */
    public function setTitle(string $title): Notes
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return Notes
     */
    public function setContent(?string $content): Notes
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     * @return Notes
     */
    public function setCreatedAt(?\DateTime $createdAt): Notes
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
