<?php

namespace App\Document;

use App\Document\Coordinates;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** 
 * @ODM\Document(repositoryClass=ProfileRepository::class) 
 * @ODM\Index(keys={"geolocation"="2d"})
 */
class Profile
{
    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @ODM\Field(type="string")
     */
    private $firstName;

    /**
     * @ODM\Field(type="int")
     */
    private $age;

    /**
     * @ODM\Field(type="string")
     */
    private $description;

    /**
     * @ODM\Field(type="collection")
     */
    private $hobbies = [];

    /**
     * @ODM\EmbedOne(targetDocument=Coordinates::class)
     */
    private $geolocation;

    /**
     * @ODM\Field(type="collection")
     */
    private $pictures = [];

    /**
     * @ODM\Field(type="string")
     */
    private $sex;

    /**
     * @ODM\Field(type="string")
     */
    private $preference;

    /**
     * @ODM\Field(type="int")
     */
    private $maxDistance = 10;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getfirstName(): string
    {
        return $this->firstName;
    }

    public function setfirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getHobbies(): array
    {
        return $this->hobbies;
    }

    public function setHobbies(array $hobbies): self
    {
        $this->hobbies = $hobbies;

        return $this;
    }

    public function getGeolocation(): Coordinates
    {
        return $this->geolocation;
    }

    public function setGeolocation(float $latitude, float $longitude): self
    {
        $this->geolocation = new Coordinates();
        $this->geolocation->setLatitude($latitude);
        $this->geolocation->setLongitude($longitude);

        return $this;
    }

    public function getPictures(): array
    {
        return $this->pictures;
    }

    public function setPictures(array $pictures): self
    {
        $this->pictures = $pictures;

        return $this;
    }

    public function getSex(): string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getPreference(): string
    {
        return $this->preference;
    }

    public function setPreference(string $preference): self
    {
        $this->preference = $preference;

        return $this;
    }

    public function getMaxDistance(): int
    {
        return $this->maxDistance;
    }

    public function setMaxDistance(int $maxDistance): self
    {
        $this->maxDistance = $maxDistance;

        return $this;
    }
}