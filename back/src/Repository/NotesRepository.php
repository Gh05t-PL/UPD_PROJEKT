<?php

namespace App\Repository;

use App\Document\Notes;
use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * @method Notes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Notes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Notes[]    findAll()
 * @method Notes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotesRepository extends InjectableRepository
{
    public function __construct(DocumentManager $dm)
    {
        parent::__construct($dm, Notes::class);
    }

    public function findAllNotes()
    {
        return $this->createQueryBuilder()
            ->select(['id', 'title', 'createdAt'])
            ->getQuery()
            ->execute()
            ->toArray();
    }
}
