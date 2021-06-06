<?php

namespace App\Repository;

use App\Document\MatchEntry;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;

class MatchEntryRepository extends ServiceDocumentRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatchEntry::class);
    }

    public function add($match)
    {
        $this->dm->persist($match);
        $this->dm->flush();

        return $match->getId();
    }

    public function findForProfile($id)
    {
        $qb = $this->createQueryBuilder(MatchEntry::class);
        $qb->addOr(
            $qb->expr()->field('idA')->equals($id),
            $qb->expr()->field('idB')->equals($id),
        );

        return iterator_to_array($qb->getQuery()->execute());
    }
}