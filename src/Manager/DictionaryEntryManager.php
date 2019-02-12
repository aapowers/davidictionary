<?php

namespace App\Manager;

use App\Repository\DictionaryEntryRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\DictionaryEntry;
use Doctrine\ORM\EntityManager;
use http\Exception\RuntimeException;
use Psr\Log\LoggerInterface;

class DictionaryEntryManager
{
    /**
     * @var DictionaryEntryRepository
     */
    private $dictionaryEntryRepository;
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        EntityManagerInterface $entityManager,
        DictionaryEntryRepository $dictionaryEntryRepository,
        LoggerInterface $logger
    ) {
        $this->dictionaryEntryRepository = $dictionaryEntryRepository;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    /**
     * Returns all DictionaryEntries
     **
     * @return DictionaryEntry[]
     */
    public function getAllDictionaryEntries()
    {
        return $this->dictionaryEntryRepository->findAll();
    }

    /**
     * Gets the DictionaryEntry for a given id
     *
     * @param $id
     *
     * @return DictionaryEntry
     */
    public function getDictionaryEntryById($id): DictionaryEntry
    {
        return $this->dictionaryEntryRepository->findOneBy(['id' => $id]);
    }

    /**
     * Gets the DictionaryEntry for a given term
     *
     * @param string $term
     *
     * @return DictionaryEntry|null
     */
    public function getDictionaryEntryByTerm(string $term): ?DictionaryEntry
    {

        $dictionaryEntry = $this->dictionaryEntryRepository->findByTerm($term);

        if ($dictionaryEntry) {
            return $dictionaryEntry[0];
        } else {
            return null;
        }
    }

    /**
     * Creates a new DictionaryEntry
     *
     * @param DictionaryEntry $dictionaryEntry
     * @return DictionaryEntry
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createDictionaryEntry(DictionaryEntry $dictionaryEntry)
    {
        $this->entityManager->persist($dictionaryEntry);
        $this->entityManager->flush();

        return $dictionaryEntry;
    }

    /**
     * Updates a given DictionaryEntry
     * Must be called in the context of a Symfony form
     *
     * @param DictionaryEntry $dictionaryEntry
     * @return DictionaryEntry
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateDictionaryEntry(DictionaryEntry $dictionaryEntry)
    {
        $this->entityManager->flush();

        return $dictionaryEntry;
    }

    /**
     * Deletes a given DictionaryEntry
     *
     * @param DictionaryEntry $dictionaryEntry
     *
     * @return DictionaryEntry
     * @throws \Doctrine\ORM\ORMException
     */
    public function deleteDictionaryEntry(DictionaryEntry $dictionaryEntry)
    {
        $this->entityManager->remove($dictionaryEntry);
        $this->entityManager->flush();

        return $dictionaryEntry;
    }
}
