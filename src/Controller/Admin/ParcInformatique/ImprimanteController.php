<?php

namespace App\Controller\Admin\ParcInformatique;

use App\Entity\Imprimante;
use App\Form\ImprimanteType;
use App\Repository\ImprimanteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/parc/informatique/imprimante', name: 'app_admin_parc_informatique_imprimante_',)]
final class ImprimanteController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(ImprimanteRepository $imprimanteRepository): Response
    {
        return $this->render('admin/parc_informatique/imprimante/index.html.twig', [
            'imprimantes' => $imprimanteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $imprimante = new Imprimante();
        $form = $this->createForm(ImprimanteType::class, $imprimante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($imprimante);
            $entityManager->flush();

            $this->addFlash('info', 'L\'imprimante a bien été ajoutée 👍👍');
            return $this->redirectToRoute('app_admin_parc_informatique_imprimante_add', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/parc_informatique/imprimante/new.html.twig', [
            'imprimante' => $imprimante,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Imprimante $imprimante): Response
    {
        return $this->render('admin/parc_informatique/imprimante/show.html.twig', [
            'imprimante' => $imprimante,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Imprimante $imprimante, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ImprimanteType::class, $imprimante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('info', 'L\'imprimante a bien été modifiée 👍👍');
            return $this->redirectToRoute('app_admin_parc_informatique_imprimante_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/parc_informatique/imprimante/edit.html.twig', [
            'imprimante' => $imprimante,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Request $request, Imprimante $imprimante, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($imprimante);
        $entityManager->flush();

        $this->addFlash('info', 'L\'imprimante a bien été supprimée 👍👍');
        return $this->redirectToRoute('app_admin_parc_informatique_imprimante_index', [], Response::HTTP_SEE_OTHER);
    }
}
