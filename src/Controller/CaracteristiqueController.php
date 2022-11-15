<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CaracteristiqueRepository;


class CaracteristiqueController extends AbstractController
{
    /**
     * @Route("/usager", name="app_usager")
     */
    public function list(CaracteristiqueRepository $caracteristiqueRepository): JsonResponse
    {
        $caracteristiques = $caracteristiqueRepository->findAll();

        return $this->json($caracteristiques);
    }

    /**
     * @Route("/api/usager/{id}", name="show_usager", methods={"GET","HEAD"})
     */
    public function show(CaracteristiqueRepository $caracteristiqueRepository, int $id): JsonResponse
    {
        $caracteristique = $caracteristiqueRepository->find($id);
        return $this->json($caracteristique);
    }
}
