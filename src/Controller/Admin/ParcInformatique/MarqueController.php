<?php

namespace App\Controller\Admin\ParcInformatique;

use App\Entity\Marque;
use App\Form\MarqueType;
use App\Repository\MarqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/parc/informatique/marque', name: 'app_admin_parc_informatique_marque_')]
final class MarqueController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(MarqueRepository $marqueRepository): Response
    {
        return $this->render('admin/parc_informatique/marque/index.html.twig', [
            'marques' => $marqueRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $marque = new Marque();
        $form = $this->createForm(MarqueType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($marque);
            $entityManager->flush();

            $this->addFlash('info', 'La marque a bien été ajoutée 👍👍');
            return $this->redirectToRoute('app_admin_parc_informatique_marque_add', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/parc_informatique/marque/new.html.twig', [
            'marque' => $marque,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Marque $marque): Response
    {
        return $this->render('admin/parc_informatique/marque/show.html.twig', [
            'marque' => $marque,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Marque $marque, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MarqueType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('info', 'La marque a bien été modifiée 👍👍');
            return $this->redirectToRoute('app_admin_parc_informatique_marque_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/parc_informatique/marque/edit.html.twig', [
            'marque' => $marque,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Request $request, Marque $marque, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($marque);
        $entityManager->flush();

        $this->addFlash('info', 'La marque a bien été supprimée 👍👍');
        return $this->redirectToRoute('app_admin_parc_informatique_marque_index', [], Response::HTTP_SEE_OTHER);
    }
}
