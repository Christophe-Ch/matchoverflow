<?php

namespace App\Controller;

use App\Service\ProfileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/rec")
 */
class RecommendationController extends AbstractController
{
    /**
     * @Route("", name="fetchRecommendations", methods={"GET"}))
     */
    public function fetchRecommendations(ProfileService $profileService)
    {
        $profiles = $profileService->fetchRecommendations();

        return $this->json($profiles);
    }
}
