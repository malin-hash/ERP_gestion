<?php

namespace App\Controller\Admin\Clientelle;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/clientelle/client', name: 'app_admin_clientelle_client_')]
final class ClientController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(ClientRepository $clientRepository): Response
    {
        return $this->render('admin/clientelle/client/index.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($client);
            $entityManager->flush();

            $this->addFlash('info', 'Le client a bien été ajouté 👍👍');
            return $this->redirectToRoute('app_admin_clientelle_client_add', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/clientelle/client/new.html.twig', [
            'client' => $client,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_clientelle_client_show', methods: ['GET'])]
    public function show(Client $client): Response
    {
        return $this->render('admin/clientelle/client/show.html.twig', [
            'client' => $client,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Client $client, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('info', 'Le client a bien été modifié 👍👍');
            return $this->redirectToRoute('app_admin_clientelle_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/clientelle/client/edit.html.twig', [
            'client' => $client,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Client $client, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($client);
        $entityManager->flush();

        $this->addFlash('info', 'Le client a bien été supprimé 👍👍');
        return $this->redirectToRoute('app_admin_clientelle_client_index', [], Response::HTTP_SEE_OTHER);
    }
}
