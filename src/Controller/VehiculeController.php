<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VehiculeRepository;


class VehiculeController extends AbstractController
{
    /**
     * @Route("/usager", name="app_usager")
     */
    public function list(VehiculeRepository $vehiculeRepository): JsonResponse
    {
        $vehicules = $vehiculeRepository->findAll();

        return $this->json($vehicules);
    }

    /**
     * @Route("/api/usager/{id}", name="show_usager", methods={"GET","HEAD"})
     */
    public function show(VehiculeRepository $vehiculeRepository, int $id): JsonResponse
    {
        $vehicule = $vehiculeRepository->find($id);
        return $this->json($vehicule);
    }


    /**
     * @Route("/api/vehicule/{num_Acc}", name="searchByNum_Acc_vehicule", methods={"GET","HEAD"})
     */
    public function searchByNum_Acc(VehiculeRepository $vehiculeRepository, string $num_Acc): JsonResponse
    {
        $data = $vehiculeRepository->findByNum_Acc($num_Acc);
        return $this->json($data);
    }
}
