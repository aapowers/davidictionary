<?php

namespace App\Manager;

use App\Repository\DictionaryEntryRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\DictionaryEntry;
use Doctrine\ORM\EntityManager;
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
     * Gets the DictionaryEntry for a given term
     *
     * @param string $term
     *
     * @return DictionaryEntry[]
     */
    public function getDictionaryEntryByTerm(string $term)
    {
        return $this->dictionaryEntryRepository->findByTerm($term);
    }

    /**
     * Creates a new DictionaryEntry
     *
     * @return DictionaryEntry
     * @throws \Doctrine\ORM\ORMException
     */
    public function createDictionaryEntry(DictionaryEntry $dictionaryEntry)
    {
        $this->entityManager->persist($dictionaryEntry);
        $this->entityManager->flush();

        return $dictionaryEntry;
    }

    /**
     * Updates a given DictionaryEntry
     *
     * @param DictionaryEntry $dictionaryEntry
     * @param string $term
     * @param string $definition
     *
     * @return DictionaryEntry
     * @throws \Doctrine\ORM\ORMException
     */
    public function updateDictionaryEntry(DictionaryEntry $dictionaryEntry, string $term, string $definition)
    {
        $dictionaryEntry->setTerm($term);
        $dictionaryEntry->setDefinition($definition);
        $this->entityManager->persist($dictionaryEntry);
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
