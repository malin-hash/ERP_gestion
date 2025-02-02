<?php

namespace App\Controller\Admin\ParcInformatique;

use App\Entity\Ordinateur;
use App\Form\OrdinateurType;
use App\Repository\OrdinateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/parc/informatique/ordinateur', name: 'app_admin_parc_informatique_ordinateur_')]
final class OrdinateurController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(OrdinateurRepository $ordinateurRepository): Response
    {
        return $this->render('admin/parc_informatique/ordinateur/index.html.twig', [
            'ordinateurs' => $ordinateurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ordinateur = new Ordinateur();
        $form = $this->createForm(OrdinateurType::class, $ordinateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ordinateur);
            $entityManager->flush();

            $this->addFlash('info', 'L\'ordinateur a bien été ajouté 👍👍');

            return $this->redirectToRoute('app_admin_parc_informatique_ordinateur_add', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/parc_informatique/ordinateur/new.html.twig', [
            'ordinateur' => $ordinateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Ordinateur $ordinateur): Response
    {
        return $this->render('admin/parc_informatique/ordinateur/show.html.twig', [
            'ordinateur' => $ordinateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ordinateur $ordinateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OrdinateurType::class, $ordinateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('info', 'L\'ordinateur a bien été modifié 👍👍');

            return $this->redirectToRoute('app_admin_parc_informatique_ordinateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/parc_informatique/ordinateur/edit.html.twig', [
            'ordinateur' => $ordinateur,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Request $request, Ordinateur $ordinateur, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($ordinateur);
        $entityManager->flush();

        $this->addFlash('info', 'L\'ordinateur a bien été supprimé 👍👍');
        return $this->redirectToRoute('app_admin_parc_informatique_ordinateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
