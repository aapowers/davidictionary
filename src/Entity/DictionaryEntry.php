<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Entity(repositoryClass="App\Repository\DictionaryEntryRepository")
 * @ORM\Table(options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
class DictionaryEntry
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotNull()
     * @Assert\Length(max=100)
     * @ORM\Column(type="string", length=100)
     */
    private $term;

    /**
     * @var string
     *
     * @Assert\NotNull()
     * @Assert\Length(max=1000)
     * @ORM\Column(type="string", length=1000)
     */
    private $definition;

    /**
     * Entry constructor.
     *
     * @codeCoverageIgnore
     *
     * @param string $term
     * @param string $definition
     */
    public function __construct(string $term, string $definition)
    {
        $this->term = $term;
        $this->definition = $definition;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $term
     * @return DictionaryEntry
     */
    public function setTerm(string $term): DictionaryEntry
    {
        $this->term = $term;
        return $this;
    }

    /**
     * @return string
     */
    public function getTerm(): string
    {
        return $this->term;
    }

    /**
     * @param string $definition
     * @return DictionaryEntry
     */
    public function setDefinition(string $definition): DictionaryEntry
    {
        $this->definition = $definition;
        return $this;
    }

    /**
     * @return string
     */
    public function getDefinition(): string
    {
        return $this->definition;
    }
}
