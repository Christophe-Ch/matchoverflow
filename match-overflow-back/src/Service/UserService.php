<?php

namespace App\Service;

use App\Document\User;
use App\Request\SignupRequest;
use App\Repository\UserRepository;
use App\Service\ProfileService;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    private $userRepository;
    private $profileService;
    private $passwordEncoder;

    public function __construct(UserRepository $userRepository, ProfileService $profileService, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->profileService = $profileService;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function createUser(SignupRequest $request)
    {
        $user = $this->userRepository->loadUserByIdentifier($request->getEmail());

        if ($user)
        {
            return false;
        }

        $profileId = $this->profileService->createProfile($request);

        $user = new User();
        $user->setEmail($request->getEmail());
        $user->setPassword(
            $this->passwordEncoder->encodePassword($user, $request->getPassword())
        );
        $user->setProfileId($profileId);


        return $this->userRepository->add($user);
    }
}