<?php

namespace App\Controller\Admin\ParcInformatique;

use App\Entity\Typemateriel;
use App\Form\TypematerielType;
use App\Repository\TypematerielRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/parc/informatique/type', name: 'app_admin_parc_informatique_type_')]
final class TypeController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(TypematerielRepository $typematerielRepository): Response
    {
        return $this->render('admin/parc_informatique/type/index.html.twig', [
            'typemateriels' => $typematerielRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typemateriel = new Typemateriel();
        $form = $this->createForm(TypematerielType::class, $typemateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typemateriel);
            $entityManager->flush();

            $this->addFlash('info', 'La marque a bien été ajoutée 👍👍');
            return $this->redirectToRoute('app_admin_parc_informatique_type_add', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/parc_informatique/type/new.html.twig', [
            'typemateriel' => $typemateriel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Typemateriel $typemateriel): Response
    {
        return $this->render('admin/parc_informatique/type/show.html.twig', [
            'typemateriel' => $typemateriel,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Typemateriel $typemateriel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypematerielType::class, $typemateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();


            $this->addFlash('info', 'La marque a bien été modifiée 👍👍');
            return $this->redirectToRoute('app_admin_parc_informatique_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/parc_informatique/type/edit.html.twig', [
            'typemateriel' => $typemateriel,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Request $request, Typemateriel $typemateriel, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($typemateriel);
        $entityManager->flush();


        $this->addFlash('info', 'La marque a bien été supprimée 👍👍');
        return $this->redirectToRoute('app_admin_parc_informatique_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
