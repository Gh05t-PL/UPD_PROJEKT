<?php

namespace App\Controller;

use App\Services\NotesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NotesRestController
 * @package App\Controller
 */
class NotesRestController extends AbstractController
{

    /**
     * @var NotesService
     */
    private $notesService;

    public function __construct(
        NotesService $notesService
    )
    {
        $this->notesService = $notesService;
    }

    /**
     * Create new note
     *
     * @Route("/notes", methods={"POST"})
     *
     * @param Request $request
     * @return Response
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function create(Request $request): Response
    {
        $newNote = $this->notesService->create(
            $request->getContent()
        );

        return $this->json([
            'success' => true,
            'data' => ['id' => $newNote->getId()],
            'errors' => null,
        ]);
    }

    /**
     * Update note
     *
     * @Route("/notes/{id}", methods={"PUT"})
     *
     * @param string $id
     * @param Request $request
     * @return Response
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function update(string $id, Request $request): Response
    {
        $this->notesService->update(
            $request->getContent(),
            $id
        );

        return $this->json([
            'success' => true,
            'data' => ['id' => $id],
            'errors' => null,
        ]);
    }

    /**
     * Fetch note
     *
     * @Route("/notes/{id}", methods={"GET"})
     *
     * @param string $id
     * @return Response
     */
    public function fetch(string $id): Response
    {
        $note = $this->notesService->fetch(
            $id
        );

        return $this->json([
            'success' => true,
            'data' => $note,
            'errors' => null,
        ]);
    }

    /**
     * Fetch all notes
     *
     * @Route("/notes", methods={"GET"})
     */
    public function fetchAll(): Response
    {
        $notes = $this->notesService->fetchAll();

        return $this->json([
            'success' => true,
            'data' => $notes,
            'errors' => null,
        ]);
    }

    /**
     * Remove note
     *
     * @Route("/notes/{id}", methods={"DELETE"})
     *
     * @param string $id
     * @return Response
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function delete(string $id): Response
    {
        $this->notesService->delete($id);

        return $this->json([
            'success' => true,
            'data' => ['id' => $id],
            'errors' => null,
        ]);
    }

    /**
     * Remove note
     *
     * @Route("/notes/{id}", methods={"OPTIONS"})
     *
     * @param string $id
     * @return Response
     */
    public function op(string $id): Response
    {
        return $this->json([]);
    }

    /**
     * Remove note
     *
     * @Route("/notes", methods={"OPTIONS"})
     *
     * @param string $id
     * @return Response
     */
    public function op2(): Response
    {
        return $this->json([]);
    }
}
