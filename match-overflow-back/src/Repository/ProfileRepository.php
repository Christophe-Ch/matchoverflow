<?php

namespace App\Repository;

use App\Document\Profile;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;

class ProfileRepository extends ServiceDocumentRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Profile::class);
    }

    public function add($profile)
    {
        $this->dm->persist($profile);
        $this->dm->flush();

        return $profile->getId();
    }

    public function update()
    {
        $this->dm->flush();
    }

    public function fetchRecommendations($profile)
    {
        $query = [
            "id" => ["\$ne" => $profile->getId()],
            "geolocation" => [
                "\$near" => [$profile->getGeolocation()->getLatitude(), $profile->getGeolocation()->getLongitude()],
                "\$maxDistance" => $profile->getMaxDistance()/111.12
            ],
        ];

        if($profile->getPreference() != "ALL") {
            $query["sex"] = [
                "\$eq" => $profile->getPreference()
            ];
        }

        $profiles = $this->findBy($query);

        return $profiles;
    }
}