<?php

namespace App\Controller;

use App\Document\User;
use App\Form\Type\SignupRequestType;
use App\Form\Type\UpdateProfileRequestType;
use App\Form\Type\UpdateGeolocationRequestType;
use App\Request\SignupRequest;
use App\Request\UpdateProfileRequest;
use App\Request\UpdateGeolocationRequest;
use App\Service\ProfileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @Route("/api/profile")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("", name="getSelf", methods={"GET"}))
     */
    public function getSelf(Request $request, ProfileService $profileService)
    {
        $profile = $profileService->getConnectedProfile();

        return $this->json($profile);
    }

    /**
     * @Route("/{id}", name="getById", methods={"GET"}))
     */
    public function getById($id, ProfileService $profileService)
    {
        $profile = $profileService->getProfile($id);

        return $this->json($profile);
    }

    /**
     * @Route("", name="update", methods={"PUT"}))
     */
    public function update(Request $request, ProfileService $profileService)
    {
        $data = json_decode($request->getContent(), true);

        $updateProfileRequest = new UpdateProfileRequest();
        $form = $this->createForm(UpdateProfileRequestType::class, $updateProfileRequest);

        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid())
        {
            $result = $profileService->updateProfile($updateProfileRequest);
            return $this->json($result);
        }

        return $this->json(false);
    }

    /**
     * @Route("/geolocation", name="updateGeolocation", methods={"PUT"}))
     */
    public function updateGeolocation(Request $request, ProfileService $profileService)
    {
        $data = json_decode($request->getContent(), true);

        $updateGeolocationRequest = new UpdateGeolocationRequest();
        $form = $this->createForm(UpdateGeolocationRequestType::class, $updateGeolocationRequest);

        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid())
        {
            $result = $profileService->updateGeolocation($updateGeolocationRequest);
            return $this->json($result);
        }

        return $this->json(false);
    }
}
