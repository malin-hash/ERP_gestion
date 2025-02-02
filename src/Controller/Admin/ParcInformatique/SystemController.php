<?php

namespace App\Controller\Admin\ParcInformatique;

use App\Entity\System;
use App\Form\SystemType;
use App\Repository\SystemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/parc/informatique/system', name: 'app_admin_parc_informatique_system_')]
final class SystemController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(SystemRepository $systemRepository): Response
    {
        return $this->render('admin/parc_informatique/system/index.html.twig', [
            'systems' => $systemRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $system = new System();
        $form = $this->createForm(SystemType::class, $system);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($system);
            $entityManager->flush();

            $this->addFlash('info', 'Le système a bien été ajoutée 👍👍');

            return $this->redirectToRoute('app_admin_parc_informatique_system_add', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/parc_informatique/system/new.html.twig', [
            'system' => $system,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(System $system): Response
    {
        return $this->render('admin/parc_informatique/system/show.html.twig', [
            'system' => $system,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, System $system, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SystemType::class, $system);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('info', 'Le système a bien été modifié 👍👍');

            return $this->redirectToRoute('app_admin_parc_informatique_system_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/parc_informatique/system/edit.html.twig', [
            'system' => $system,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Request $request, System $system, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($system);
        $entityManager->flush();

        $this->addFlash('info', 'Le système a bien été supprimé 👍👍');
        return $this->redirectToRoute('app_admin_parc_informatique_system_index', [], Response::HTTP_SEE_OTHER);
    }
}
