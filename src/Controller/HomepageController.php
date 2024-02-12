<?php

namespace App\Controller;

use App\Repository\BrandRepository;
use App\Repository\EnergyRepository;
use App\Repository\HoursRepository;
use App\Repository\OptionRepository;
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
    public function showCars(
        PostRepository $postRepository,
    ): Response
    {
        $posts = $postRepository->findAll();
        foreach($posts as $post) {
            $brand = $post->getBrand();
            $brandName = $brand->getName();
        }

        

        return $this->render('homepage/cars.html.twig', [
            'controller_name' => 'HomepageController',
            'posts' => $posts,
            'brandName' => $brandName
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

    #[Route('/carDetail/{id}', name: 'carDetail')]
    public function carDetail(        
    PostRepository $postRepository,
    OptionRepository $optionRepository,
    int $id=null
    ): Response
    {
        $post = $postRepository->findBy(['id' => $id])[0];

        $optionNames = [];
        $brand = $post->getBrand();
        $brandName = $brand->getName();
        $energy = $post->getEnergy();
        $energyName = $energy->getName();

        if($optionNames !== null) {
            foreach($post->getOptions() as $options) {
                array_push($optionNames, $options->getName());
            }
        }

        return $this->render('homepage/car_detail.html.twig', [
            'controller_name' => 'HomepageController',
            'post' => $post,
            'brandName' => $brandName,
            'energyName' => $energyName,
            'optionNames' => $optionNames

        ]);
    }

}
