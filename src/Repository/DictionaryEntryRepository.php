<?php

namespace App\Repository;

use App\Entity\DictionaryEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class DictionaryEntryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DictionaryEntry::class);
    }

    /**
     * @param $term
     * @return DictionaryEntry[]
     */
    public function findByTerm($term): array
    {
        $qb = $this->createQueryBuilder('e')
            ->andWhere('e.term = :term')
            ->setParameter('term', $term)
            ->getQuery();

        return $qb->execute();
    }
}