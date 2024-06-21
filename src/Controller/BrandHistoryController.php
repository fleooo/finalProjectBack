<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BrandHistoryController extends AbstractController
{
    #[Route('/brand/history', name: 'app_brand_history')]
    public function index(): Response
    {
        return $this->render('brand_history/brand_history.html.twig', [
            'controller_name' => 'BrandHistoryController',
        ]);
    }
}
