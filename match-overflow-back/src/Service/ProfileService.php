<?php

namespace App\Service;

use App\Document\Profile;
use App\Request\SignupRequest;
use App\Request\UpdateProfileRequest;
use App\Request\UpdateGeolocationRequest;
use App\Repository\ProfileRepository;
use Symfony\Component\Security\Core\Security;

class ProfileService
{
    private $profileRepository;

    public function __construct(ProfileRepository $profileRepository, Security $security)
    {
        $this->profileRepository = $profileRepository;
        $this->security = $security;
    }

    public function createProfile(SignupRequest $request)
    {
        $profile = new Profile();
        $profile->setFirstName($request->getFirstName());
        $profile->setAge($request->getAge());
        $profile->setSex($request->getSex());
        $profile->setPreference($request->getPreference());
        $profile->setGeolocation($request->getLatitude(), $request->getLongitude());

        return $this->profileRepository->add($profile);
    }

    public function getConnectedProfile()
    {
        $user = $this->security->getUser();

        return $this->profileRepository->find($user->getProfileId());
    }

    public function getProfile(string $id)
    {
        return $this->profileRepository->find($id);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $profile = $this->getConnectedProfile();
        
        $profile->setDescription($request->getDescription());
        $profile->setHobbies($request->getHobbies());
        $profile->setPreference($request->getPreference());
        $profile->setMaxDistance($request->getMaxDistance());

        $this->profileRepository->update();

        return $profile;
    }

    public function updateGeolocation(UpdateGeolocationRequest $request)
    {
        $profile = $this->getConnectedProfile();
        
        $profile->setGeolocation([$request->getLatitude(), $request->getLongitude()]);

        $this->profileRepository->update();

        return $profile;
    }

    public function fetchRecommendations()
    {
        $profile = $this->getConnectedProfile();

        $profiles = $this->profileRepository->fetchRecommendations($profile);

        return $profiles;
    }
}