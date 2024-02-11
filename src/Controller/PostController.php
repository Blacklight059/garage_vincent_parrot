<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Energy;
use App\Entity\Images;
use App\Entity\Option;
use App\Entity\Post;
use App\Form\PostType;
use App\Repository\ImagesRepository;
use App\Repository\OptionRepository;
use App\Repository\PostRepository;
use App\ServiceImages\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('employee/post')]
class PostController extends AbstractController
{
    #[Route('/', name: 'app_post_index', methods: ['GET'])]
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('post/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_post_new', methods: ['GET', 'POST'])]
    public function new(Request $request, 
    PictureService $pictureService, 
    EntityManagerInterface $entityManager): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
            $images = $form->get('images')->getData();
            foreach($images as $image){
                $folder = 'post/';
                // On génère un nouveau nom de fichier
                $fichier = $pictureService->add($image, $folder, 300, 300);

                $img = new Images();
                $img->setName($fichier);
                $post->addImage($img);
     
            }
            
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('post/new.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_post_show', methods: ['GET'])]
    public function show(Post $post): Response
    {
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_post_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, 
    Post $post, 
    PostRepository $postRepository,
    ImagesRepository $imagesRepository,
    OptionRepository $optionRepository,
    PictureService $pictureService,
    EntityManagerInterface $entityManager,
    int $id=null): Response
    {
        
        $post = $postRepository->findBy(['id' => $id])[0];
        $oldImages = $imagesRepository->findBy(['post' => $id]);
        $oldOptions = $optionRepository->findBy(['post' => $id]);
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach($oldImages as $oldImage) {
                $entityManager->remove($oldImage);            
            }
            foreach($oldOptions as $oldOption) {
                $entityManager->remove($oldOption);            
            }

            $images = $form->get('images')->getData();
            $options = $form->get('options')->getData();
            $brands = $form->get('brands')->getData();
            $energies = $form->get('energies')->getData();

            $newPost = $form->getData();

            // On boucle sur les images
            foreach($images as $image){
                $folder = 'service/';
                // On génère un nouveau nom de fichier
                $fichier = $pictureService->add($image, $folder, 300, 300);

                $img = new Images();
                $img->setName($fichier);
                $post->addImage($img);
    
            }

            foreach($options as $option)
            {
                $optionNew = new Option();
                $optionNew->setName($option->getName());
                $optionNew->addPost($post);

                $entityManager->persist($optionNew);
            }

            foreach($brands as $brand)
            {
                $brandNew = new Brand();
                $brandNew->setName($brand->getName());
                $brandNew->setPost($post);

                $entityManager->persist($brandNew);
            }

            foreach($energies as $energy)
            {
                $energyNew = new Energy();
                $energyNew->setName($energy->getName());
                $energyNew->setPost($post);

                $entityManager->persist($energyNew);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('post/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_post_delete', methods: ['POST'])]
    public function delete(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
    }
}
