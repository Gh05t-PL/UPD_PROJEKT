<?php


namespace App\Services;


use App\Document\Notes;
use App\Dto\NotesDto;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class NotesService
 * @package App\Services
 */
class NotesService
{
    /**
     * @var DocumentManager
     */
    private $documentManager;
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * NotesService constructor.
     * @param DocumentManager $documentManager
     * @param SerializerInterface $serializer
     */
    public function __construct(
        DocumentManager $documentManager,
        SerializerInterface $serializer
    )
    {
        $this->documentManager = $documentManager;
        $this->serializer = $serializer;
    }

    /**
     * @param string $data
     * @return Notes
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function create(string $data)
    {
        /** @var NotesDto $noteDto */
        $noteDto = $this->serializer->deserialize(
            $data,
            NotesDto::class,
            'json'
        );

        $note = new Notes();
        $note
            ->setCreatedAt(new \DateTime())
            ->setContent($noteDto->getContent())
            ->setTitle($noteDto->getTitle());


        $this->documentManager->persist($note);
        $this->documentManager->flush();

        return $note;
    }

    /**
     * @param string $data
     * @param int $id
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function update(string $data, string $id)
    {
        /** @var NotesDto $noteDto */
        $noteDto = $this->serializer->deserialize(
            $data,
            NotesDto::class,
            'json'
        );

        $note = $this->documentManager->getRepository(Notes::class)->find($id);
        $note
            ->setContent($noteDto->getContent())
            ->setTitle($noteDto->getTitle());

        $this->documentManager->flush();
    }

    /**
     * @param int $id
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function delete(string $id)
    {
        $note = $this->documentManager->getRepository(Notes::class)->find($id);

        $this->documentManager->remove($note);
        $this->documentManager->flush();
    }

    /**
     * @param int $id
     * @return Notes|null
     */
    public function fetch(string $id)
    {
        return $this->documentManager->getRepository(Notes::class)->find($id);
    }

    /**
     * @return Notes[]|array
     */
    public function fetchAll()
    {
        return $this->documentManager->getRepository(Notes::class)->findAllNotes();
    }
}
