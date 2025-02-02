<?php

namespace App\Controller\Admin;

use App\Entity\Bureau;
use App\Form\BureauType;
use App\Repository\BureauRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/bureau', name: 'app_admin_bureau_')]
final class BureauController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(BureauRepository $bureauRepository): Response
    {
        return $this->render('admin/bureau/index.html.twig', [
            'bureaus' => $bureauRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bureau = new Bureau();
        $form = $this->createForm(BureauType::class, $bureau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bureau);
            $entityManager->flush();

            $this->addFlash('info', 'Le bureau a bien été ajouté 👍👍');
            return $this->redirectToRoute('app_admin_bureau_add', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/bureau/new.html.twig', [
            'bureau' => $bureau,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Bureau $bureau): Response
    {
        return $this->render('admin/bureau/show.html.twig', [
            'bureau' => $bureau,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bureau $bureau, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BureauType::class, $bureau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('info', 'Le bureau a bien été modifié 👍👍');
            return $this->redirectToRoute('app_admin_bureau_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/bureau/edit.html.twig', [
            'bureau' => $bureau,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Request $request, Bureau $bureau, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($bureau);
        $entityManager->flush();

        $this->addFlash('info', 'Le bureau a bien été supprimé 👍👍');
        return $this->redirectToRoute('app_admin_bureau_index', [], Response::HTTP_SEE_OTHER);
    }
}
