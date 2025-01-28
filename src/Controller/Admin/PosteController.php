<?php

namespace App\Controller\Admin;

use App\Entity\Poste;
use App\Form\PosteType;
use App\Repository\PosteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/poste', name: 'app_admin_poste_')]
final class PosteController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(PosteRepository $posteRepository): Response
    {
        return $this->render('admin/poste/index.html.twig', [
            'postes' => $posteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $poste = new Poste();
        $form = $this->createForm(PosteType::class, $poste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($poste);
            $entityManager->flush();

            $this->addFlash('success', 'Le poste crée avec succès');
            return $this->redirectToRoute('app_admin_poste_add', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/poste/new.html.twig', [
            'poste' => $poste,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_poste_show', methods: ['GET'])]
    public function show(Poste $poste): Response
    {
        return $this->render('admin/poste/show.html.twig', [
            'poste' => $poste,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Poste $poste, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PosteType::class, $poste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('info', 'Le poste a bien été modifié 👍👍');
            return $this->redirectToRoute('app_admin_poste_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/poste/edit.html.twig', [
            'poste' => $poste,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Poste $poste, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($poste);
        $entityManager->flush();

        $this->addFlash('info', 'Le poste a bien été supprimé 👍👍');
        return $this->redirectToRoute('app_admin_poste_index', [], Response::HTTP_SEE_OTHER);
    }
}
