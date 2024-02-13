<?php

namespace App\Controller;

use App\Repository\HoursRepository;
use App\Repository\OptionRepository;
use App\Repository\PostRepository;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use App\Repository\ReviewRepository;
use App\Services\MailerService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'Homepage')]
    public function index(
        ServiceRepository $serviceRepository,
        ReviewRepository $reviewRepository
    ): Response
    {
        $services = $serviceRepository->findAll();
        $reviews = $reviewRepository->findAll();
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'services' => $services,
            'reviews' => $reviews
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
    Request $request, 
    MailerService $mailer,
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

        // contact form for car
        $postName = $post->getTitle();

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();
            $subject = 'Demande de contact sur votre site de ' . $contactFormData['email'] . ' au sujet de la voiture' . $postName;
            $content = $contactFormData['name'] . ' vous a envoyé le message suivant: ' . $contactFormData['message'];
            $mailer->sendEmail(subject: $subject, content: $content);
            $this->addFlash('success', 'Votre message a été envoyé');
            return $this->redirectToRoute('homepage');
        }

        return $this->render('homepage/car_detail.html.twig', [
            'controller_name' => 'HomepageController',
            'post' => $post,
            'brandName' => $brandName,
            'energyName' => $energyName,
            'optionNames' => $optionNames,
            'form' => $form->createView()

        ]);
    }

    
    #[Route('/contact', name: 'contact')]
    public function contact(
        Request $request, 
        MailerService $mailer
    )
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();
            $subject = 'Demande de contact sur votre site de ' . $contactFormData['email'];
            $content = $contactFormData['name'] . ' vous a envoyé le message suivant: ' . $contactFormData['message'];
            $mailer->sendEmail(subject: $subject, content: $content);
            $this->addFlash('success', 'Votre message a été envoyé');
            return $this->redirectToRoute('homepage');
        }
        return $this->render('homepage/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
