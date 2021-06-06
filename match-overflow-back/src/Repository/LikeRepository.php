<?php

namespace App\Repository;

use App\Document\Like;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;

class LikeRepository extends ServiceDocumentRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Like::class);
    }

    public function add($like)
    {
        $this->dm->persist($like);
        $this->dm->flush();

        return $like->getId();
    }

    public function findLike($idA, $idB)
    {
        $qb = $this->createQueryBuilder(Like::class);
        $qb->addAnd(
            $qb->expr()->field('from')->equals($idA),
            $qb->expr()->field('to')->equals($idB)
        );

        return $qb->getQuery()->getSingleResult();
    }

    public function findLikesTowards($id)
    {
        $likes = $this->findBy(['to' => $id]);
        return $likes;
    }

    public function findLikesCount($idA, $idB)
    {
        $qb = $this->createQueryBuilder(Like::class);
        $qb->addOr(
            $qb->expr()->addAnd(
                $qb->expr()->field('from')->equals($idA),
                $qb->expr()->field('to')->equals($idB)
            ),
            $qb->expr()->addAnd(
                $qb->expr()->field('to')->equals($idA),
                $qb->expr()->field('from')->equals($idB)
            )
        );

        return iterator_count($qb->getQuery()->execute());
    }
}