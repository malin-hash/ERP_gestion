<?php

namespace App\Controller\Admin\ParcInformatique;

use App\Entity\Generation;
use App\Form\GenerationType;
use App\Repository\GenerationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/parc/informatique/generation', name: 'app_admin_parc_informatique_generation_')]
final class GenerationController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(GenerationRepository $generationRepository): Response
    {
        return $this->render('admin/parc_informatique/generation/index.html.twig', [
            'generations' => $generationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $generation = new Generation();
        $form = $this->createForm(GenerationType::class, $generation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($generation);
            $entityManager->flush();

            $this->addFlash('info', 'La génération a bien été ajoutée 👍👍');
            return $this->redirectToRoute('app_admin_parc_informatique_generation_add', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/parc_informatique/generation/new.html.twig', [
            'generation' => $generation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Generation $generation): Response
    {
        return $this->render('admin/parc_informatique/generation/show.html.twig', [
            'generation' => $generation,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Generation $generation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GenerationType::class, $generation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('info', 'La génération a bien été modifiée 👍👍');
            return $this->redirectToRoute('app_admin_parc_informatique_generation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/parc_informatique/generation/edit.html.twig', [
            'generation' => $generation,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Request $request, Generation $generation, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($generation);
        $entityManager->flush();

        $this->addFlash('info', 'La génération a bien été supprimée 👍👍');
        return $this->redirectToRoute('app_admin_parc_informatique_generation_index', [], Response::HTTP_SEE_OTHER);
    }
}
