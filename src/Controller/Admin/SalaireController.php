<?php

namespace App\Controller\Admin;

use App\Entity\Salaire;
use App\Form\SalaireType;
use App\Repository\SalaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/salaire', name: 'app_admin_salaire_')]
final class SalaireController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(SalaireRepository $salaireRepository): Response
    {
        return $this->render('admin/salaire/index.html.twig', [
            'salaires' => $salaireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $salaire = new Salaire();
        $form = $this->createForm(SalaireType::class, $salaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($salaire);
            $entityManager->flush();

            $this->addFlash('success', 'Le salaire a bien été crée 👍👍');

            return $this->redirectToRoute('app_admin_salaire_add');
        }

        return $this->render('admin/salaire/new.html.twig', [
            'salaire' => $salaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_salaire_show', methods: ['GET'])]
    public function show(Salaire $salaire): Response
    {
        return $this->render('admin/salaire/show.html.twig', [
            'salaire' => $salaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Salaire $salaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SalaireType::class, $salaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('info', 'Le salaire a été modifié avec succès 👍👍');
            return $this->redirectToRoute('app_admin_salaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/salaire/edit.html.twig', [
            'salaire' => $salaire,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Salaire $salaire, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($salaire);
        $entityManager->flush();

        $this->addFlash('info', 'Le salaire a été supprimé avec succès 👍👍');
        return $this->redirectToRoute('app_admin_salaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
