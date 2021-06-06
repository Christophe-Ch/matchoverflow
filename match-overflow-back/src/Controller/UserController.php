<?php

namespace App\Controller;

use App\Document\User;
use App\Form\Type\SignupRequestType;
use App\Request\SignupRequest;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/api")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/signup", name="signup", methods={"POST"}))
     */
    public function signup(Request $request, UserService $userService)
    {
        $data = json_decode($request->getContent(), true);

        $signupRequest = new SignupRequest();
        $form = $this->createForm(SignupRequestType::class, $signupRequest);

        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid())
        {
            $result = $userService->createUser($signupRequest);
            return $this->json($result);
        }

        return $this->json(false);
    }
}
