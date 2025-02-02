<?php

namespace App\Controller\Admin\Clientelle;

use App\Entity\Profession;
use App\Form\Profession1Type;
use App\Repository\ProfessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/clientelle/profession', name: 'app_admin_clientelle_profession_')]
final class ProfessionController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(ProfessionRepository $professionRepository): Response
    {
        return $this->render('admin/clientelle/profession/index.html.twig', [
            'professions' => $professionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $profession = new Profession();
        $form = $this->createForm(Profession1Type::class, $profession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($profession);
            $entityManager->flush();

            $this->addFlash('success', 'La profession a bien été ajoutée 👍👍');
            return $this->redirectToRoute('app_admin_clientelle_profession_add', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/clientelle/profession/new.html.twig', [
            'profession' => $profession,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Profession $profession): Response
    {
        return $this->render('admin/clientelle/profession/show.html.twig', [
            'profession' => $profession,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Profession $profession, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Profession1Type::class, $profession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'La profession a bien été modifiée 👍👍');
            return $this->redirectToRoute('app_admin_clientelle_profession_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/clientelle/profession/edit.html.twig', [
            'profession' => $profession,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Request $request, Profession $profession, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $profession->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($profession);
            $entityManager->flush();
        }

        $this->addFlash('success', 'La profession a bien été supprimée 👍👍');
        return $this->redirectToRoute('app_admin_clientelle_profession_index', [], Response::HTTP_SEE_OTHER);
    }
}
