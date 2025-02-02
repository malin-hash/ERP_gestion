<?php

namespace App\Controller\Admin\ParcInformatique;

use App\Entity\Unitecentral;
use App\Form\UnitecentralType;
use App\Repository\UnitecentralRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/parc/informatique/unitecentral', name: 'app_admin_parc_informatique_unitecentral_')]
final class UnitecentralController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(UnitecentralRepository $unitecentralRepository): Response
    {
        return $this->render('admin/parc_informatique/unitecentral/index.html.twig', [
            'unitecentrals' => $unitecentralRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $unitecentral = new Unitecentral();
        $form = $this->createForm(UnitecentralType::class, $unitecentral);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($unitecentral);
            $entityManager->flush();

            $this->addFlash('info', 'L\'unité central a bien été ajouté 👍👍');

            return $this->redirectToRoute('app_admin_parc_informatique_unitecentral_add', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/parc_informatique/unitecentral/new.html.twig', [
            'unitecentral' => $unitecentral,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Unitecentral $unitecentral): Response
    {
        return $this->render('admin/parc_informatique/unitecentral/show.html.twig', [
            'unitecentral' => $unitecentral,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Unitecentral $unitecentral, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UnitecentralType::class, $unitecentral);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('info', 'L\'unité central a bien été modifié 👍👍');

            return $this->redirectToRoute('app_admin_parc_informatique_unitecentral_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/parc_informatique/unitecentral/edit.html.twig', [
            'unitecentral' => $unitecentral,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Request $request, Unitecentral $unitecentral, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($unitecentral);
        $entityManager->flush();
        $this->addFlash('info', 'L\'unité central a bien été supprimé 👍👍');
        return $this->redirectToRoute('app_admin_parc_informatique_unitecentral_index', [], Response::HTTP_SEE_OTHER);
    }
}
