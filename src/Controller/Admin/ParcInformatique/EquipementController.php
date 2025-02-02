<?php

namespace App\Controller\Admin\ParcInformatique;

use App\Entity\Equipement;
use App\Form\EquipementType;
use App\Repository\EquipementRepository;
use App\Repository\ImprimanteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use function PHPSTORM_META\type;

#[Route('/admin/parc/informatique/equipement', name: 'app_admin_parc_informatique_equipement_')]
final class EquipementController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(EquipementRepository $equipementRepository): Response
    {
        return $this->render('admin/parc_informatique/equipement/index.html.twig', [
            'equipements' => $equipementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ImprimanteRepository $imprimanterepository): Response
    {
        $equipement = new Equipement();
        $form = $this->createForm(EquipementType::class, $equipement);
        $form->handleRequest($request);
        $type = $form->get('materiel')->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($equipement);
            $entityManager->flush();

            if (strpos($type, 'imprimante') === 0) {
                return $this->redirectToRoute('app_admin_parc_informatique_imprimante_add', [], Response::HTTP_SEE_OTHER);
            } elseif ($type === "ordinateur") {
                return $this->redirectToRoute('app_admin_parc_informatique_ordinateur_add', [], Response::HTTP_SEE_OTHER);
            } else {
                return $this->redirectToRoute('app_admin_parc_informatique_unitecentral_add', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->render('admin/parc_informatique/equipement/new.html.twig', [
            'equipement' => $equipement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Equipement $equipement): Response
    {
        return $this->render('admin/parc_informatique/equipement/show.html.twig', [
            'equipement' => $equipement,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Equipement $equipement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EquipementType::class, $equipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('info', 'L\'equipement a bien été modifié 👍👍');
            return $this->redirectToRoute('app_admin_parc_informatique_equipement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/parc_informatique/equipement/edit.html.twig', [
            'equipement' => $equipement,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Equipement $equipement, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($equipement);
        $entityManager->flush();

        $this->addFlash('info', 'L\'equipement a bien été supprimé 👍👍');
        return $this->redirectToRoute('app_admin_parc_informatique_equipement_index', [], Response::HTTP_SEE_OTHER);
    }
}
