<?php

namespace App\Service;

use App\Document\MatchEntry;
use App\Repository\MatchEntryRepository;

class MatchEntryService
{
    private $matchEntryRepository;
    private $profileService;

    public function __construct(MatchEntryRepository $matchEntryRepository, ProfileService $profileService)
    {
        $this->matchEntryRepository = $matchEntryRepository;
        $this->profileService = $profileService;
    }

    public function getMatches()
    {
        $connected = $this->profileService->getConnectedProfile();
        $matches = $this->matchEntryRepository->findForProfile($connected->getId());
        $profiles = [];

        foreach ($matches as $match)
        {
            $other = $match->getIdA();
            if ($other == $connected->getId())
            {
                $other = $match->getIdB();
            }

            array_push($profiles, $this->profileService->getProfile($other));
        }

        return $profiles;
    }

    public function createMatch($idA, $idB)
    {
        $match = new MatchEntry();
        $match->setIdA($idA);
        $match->setIdB($idB);

        return $this->matchEntryRepository->add($match);
    }
}