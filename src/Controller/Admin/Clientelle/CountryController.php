<?php

namespace App\Controller\Admin\Clientelle;

use App\Entity\Country;
use App\Form\Country1Type;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/clientelle/country', name: 'app_admin_clientelle_country_')]
final class CountryController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(CountryRepository $countryRepository): Response
    {
        return $this->render('admin/clientelle/country/index.html.twig', [
            'countries' => $countryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $country = new Country();
        $form = $this->createForm(Country1Type::class, $country);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($country);
            $entityManager->flush();

            $this->addFlash('success', 'Le pays a bien été Ajoutée 👍👍');
            return $this->redirectToRoute('app_admin_clientelle_country_add', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/clientelle/country/new.html.twig', [
            'country' => $country,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Country $country): Response
    {
        return $this->render('admin/clientelle/country/show.html.twig', [
            'country' => $country,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Country $country, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Country1Type::class, $country);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('info', 'Le pays a bien été Modifiée 👍👍');
            return $this->redirectToRoute('app_admin_clientelle_country_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/clientelle/country/edit.html.twig', [
            'country' => $country,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Request $request, Country $country, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($country);
        $entityManager->flush();

        $this->addFlash('info', 'Le pays a bien été supprimé 👍👍');
        return $this->redirectToRoute('app_admin_clientelle_country_index', [], Response::HTTP_SEE_OTHER);
    }
}
