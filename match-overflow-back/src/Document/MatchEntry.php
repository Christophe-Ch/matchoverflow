<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(repositoryClass=MatchEntryRepository::class) */
class MatchEntry
{
    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @ODM\Field(type="string")
     */
    private $idA;

    /**
     * @ODM\Field(type="string")
     */
    private $idB;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getIdA(): string
    {
        return $this->idA;
    }

    public function setIdA(string $idA): self
    {
        $this->idA = $idA;
        return $this;
    }

    public function getIdB(): string
    {
        return $this->idB;
    }

    public function setIdB(string $idB): self
    {
        $this->idB = $idB;
        return $this;
    }
}