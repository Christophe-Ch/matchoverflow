<?php

namespace App\Controller;

use App\Document\Like;
use App\Form\Type\LikeRequestType;
use App\Request\LikeRequest;
use App\Service\LikeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/like")
 */
class LikeController extends AbstractController
{
    /**
     * @Route("", name="getLikes", methods={"GET"}))
     */
    public function getLikes(LikeService $likeService)
    {
        $likes = $likeService->getLikes();

        return $this->json($likes);
    }

    /**
     * @Route("/{id}", name="like", methods={"POST"}))
     */
    public function like($id, LikeService $likeService)
    {
        $id = $likeService->addLike($id);

        return $this->json($id);
    }
}
