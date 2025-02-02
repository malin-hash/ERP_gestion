<?php

namespace App\Controller\Admin\Clientelle;

use App\Entity\City;
use App\Form\City1Type;
use App\Repository\CityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/clientelle/city', name: 'app_admin_clientelle_city_')]
final class CityController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(CityRepository $cityRepository): Response
    {
        return $this->render('admin/clientelle/city/index.html.twig', [
            'cities' => $cityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $city = new City();
        $form = $this->createForm(City1Type::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($city);
            $entityManager->flush();

            $this->addFlash('success', 'La ville a bien été Ajoutée 👍👍');
            return $this->redirectToRoute('app_admin_clientelle_city_add', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/clientelle/city/new.html.twig', [
            'city' => $city,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(City $city): Response
    {
        return $this->render('admin/clientelle/city/show.html.twig', [
            'city' => $city,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, City $city, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(City1Type::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('info', 'La ville a bien été Modifiée 👍👍');
            return $this->redirectToRoute('app_admin_clientelle_city_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/clientelle/city/edit.html.twig', [
            'city' => $city,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Request $request, City $city, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($city);
        $entityManager->flush();

        $this->addFlash('info', 'La ville a bien été Supprimée 👍👍');
        return $this->redirectToRoute('app_admin_clientelle_city_index', [], Response::HTTP_SEE_OTHER);
    }
}
