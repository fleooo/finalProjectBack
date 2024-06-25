<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CapsuleController extends AbstractController
{
    #[Route('/capsule', name: 'app_capsule')]
    public function index(): Response
    {
        return $this->render('capsule/index.html.twig', [
            'controller_name' => 'CapsuleController',
        ]);
    }
}
