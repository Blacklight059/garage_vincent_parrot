<?php

namespace App\Controller;

use App\Repository\HoursRepository;
use App\Repository\PostRepository;
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

    #[Route('/cars', name: 'Show_cars')]
    public function showCars(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();
        return $this->render('homepage/cars.html.twig', [
            'controller_name' => 'HomepageController',
            'posts' => $posts
        ]);
    }

    #[Route('/hours', name: 'Show_hours')]
    public function showHours(HoursRepository $hoursRepository): Response
    {
        $hours = $hoursRepository->findAll();

        return $this->render('homepage/_hours.html.twig', [
            'hours' => $hours
        ]);
    }

}
