<?php

namespace App\Controller;

use App\Service\MatchEntryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/match")
 */
class MatchController extends AbstractController
{
    /**
     * @Route("", name="getMatches", methods={"GET"}))
     */
    public function getMatches(MatchEntryService $matchEntryService): Response
    {
        $matches = $matchEntryService->getMatches();

        return $this->json($matches);
    }
}
