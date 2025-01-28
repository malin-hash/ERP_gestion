<?php

namespace App\Controller\Admin\ParcInformatique;

use App\Entity\Materiel;
use App\Form\MaterielType;
use App\Repository\MaterielRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/parc/informatique/materiel', name: 'app_admin_parc_informatique_materiel_')]
final class MaterielController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(MaterielRepository $materielRepository): Response
    {
        return $this->render('admin/parc_informatique/materiel/index.html.twig', [
            'materiels' => $materielRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $materiel = new Materiel();
        $form = $this->createForm(MaterielType::class, $materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($materiel);
            $entityManager->flush();

            $this->addFlash('info', 'Le matériel a bien été ajouté 👍👍');
            return $this->redirectToRoute('app_admin_parc_informatique_materiel_add', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/parc_informatique/materiel/new.html.twig', [
            'materiel' => $materiel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Materiel $materiel): Response
    {
        return $this->render('admin/parc_informatique/materiel/show.html.twig', [
            'materiel' => $materiel,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Materiel $materiel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MaterielType::class, $materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('info', 'Le matériel a bien été modifié 👍👍');
            return $this->redirectToRoute('app_admin_parc_informatique_materiel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/parc_informatique/materiel/edit.html.twig', [
            'materiel' => $materiel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['Get'])]
    public function delete(Materiel $materiel, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($materiel);
        $entityManager->flush();

        $this->addFlash('info', 'Le matériel a bien été supprimé 👍👍');
        return $this->redirectToRoute('app_admin_parc_informatique_materiel_index', [], Response::HTTP_SEE_OTHER);
    }
}
