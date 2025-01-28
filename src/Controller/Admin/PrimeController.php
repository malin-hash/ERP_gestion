<?php

namespace App\Controller\Admin;

use App\Entity\Prime;
use App\Form\Prime1Type;
use App\Repository\PrimeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/prime', name: 'app_admin_prime_')]
final class PrimeController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(PrimeRepository $primeRepository): Response
    {
        return $this->render('admin/prime/index.html.twig', [
            'primes' => $primeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $prime = new Prime();
        $form = $this->createForm(Prime1Type::class, $prime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($prime);
            $entityManager->flush();

            $this->addFlash('success', 'La prime a bien été ajoutée 👍👍');
            return $this->redirectToRoute('app_admin_prime_add', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/prime/new.html.twig', [
            'prime' => $prime,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_prime_show', methods: ['GET'])]
    public function show(Prime $prime): Response
    {
        return $this->render('admin/prime/show.html.twig', [
            'prime' => $prime,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Prime $prime, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Prime1Type::class, $prime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('info', 'La Prime a bien été modifiée 👍👍');
            return $this->redirectToRoute('app_admin_prime_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/prime/edit.html.twig', [
            'prime' => $prime,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Request $request, Prime $prime, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($prime);
        $entityManager->flush();

        $this->addFlash('info', 'La Prime a bien été supprimée 👍👍');
        return $this->redirectToRoute('app_admin_prime_index', [], Response::HTTP_SEE_OTHER);
    }
}
