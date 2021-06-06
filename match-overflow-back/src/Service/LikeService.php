<?php

namespace App\Service;

use App\Document\Like;
use App\Repository\LikeRepository;
use App\Request\LikeRequest;
use App\Service\MatchService;
use App\Service\ProfileService;

class LikeService
{
    private $profileService;
    private $likeRepository;
    private $matchEntryService;

    public function __construct(ProfileService $profileService, LikeRepository $likeRepository, MatchEntryService $matchEntryService)
    {
        $this->profileService = $profileService;
        $this->likeRepository = $likeRepository;
        $this->matchEntryService = $matchEntryService;
    }

    public function addLike(string $id)
    {
        $from = $this->profileService->getConnectedProfile();
        $to = $this->profileService->getProfile($id);

        $like = $this->likeRepository->findLike($from->getId(), $to->getId());
        if ($like || !$from || !$to || $from->getId() == $to->getId()) {
            return false;
        }
    
        $like = new Like();
        $like->setFrom($from->getId());
        $like->setTo($id);

        $likeId = $this->likeRepository->add($like);

        $count = $this->getLikesCount($from->getId(), $to->getId());
        
        if ($count == 2)
        {
            $this->matchEntryService->createMatch($from->getId(), $to->getId());
        }

        return $likeId;
    }

    public function getLikes()
    {
        $to = $this->profileService->getConnectedProfile();
        $likes = $this->likeRepository->findLikesTowards($to->getId());
        $profiles = [];

        foreach ($likes as $like)
        {
            array_push($profiles, $this->profileService->getProfile($like->getFrom()));
        }

        return $profiles;
    }

    public function getLikesCount($idA, $idB)
    {
        return $this->likeRepository->findLikesCount($idA, $idB);
    }
}