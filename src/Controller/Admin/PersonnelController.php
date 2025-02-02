<?php

namespace App\Controller\Admin;

use App\Entity\Personnel;
use App\Form\PersonnelType;
use App\Repository\PersonnelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/personnel', name: 'app_admin_personnel_')]
final class PersonnelController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(PersonnelRepository $personnelRepository): Response
    {
        return $this->render('admin/personnel/index.html.twig', [
            'personnels' => $personnelRepository->findBy([], ['id' => 'desc']),
        ]);
    }

    #[Route('/new', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $personnel = new Personnel();
        $form = $this->createForm(PersonnelType::class, $personnel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager->persist($personnel);
            $entityManager->flush();

            $this->addFlash('success', 'Le Personnel 😎 à bien été ajouté 👍👍');
            return $this->redirectToRoute('app_admin_personnel_add', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/personnel/new.html.twig', [
            'personnel' => $personnel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_personnel_show', methods: ['GET'])]
    public function show(Personnel $personnel): Response
    {
        return $this->render('admin/personnel/show.html.twig', [
            'personnel' => $personnel,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Personnel $personnel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PersonnelType::class, $personnel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('info', 'Le personnel a bien été modifié 👍👍');
            return $this->redirectToRoute('app_admin_personnel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/personnel/edit.html.twig', [
            'personnel' => $personnel,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Personnel $personnel, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($personnel);
        $entityManager->flush();


        $this->addFlash('info', 'Le personnel a bien été supprimé 👍👍');
        return $this->redirectToRoute('app_admin_personnel_index', [], Response::HTTP_SEE_OTHER);
    }
}
