<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'Homepage')]
    public function index(ServiceRepository $serviceRepository): Response
    {
        $services = $serviceRepository->findAll();
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'services' => $services
        ]);
    }
}
