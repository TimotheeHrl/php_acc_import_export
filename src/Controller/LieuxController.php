<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LieuxRepository;


class LieuxController extends AbstractController
{
    /**
     * @Route("/usager", name="app_usager")
     */
    public function list(LieuxRepository $lieuxRepository): JsonResponse
    {
        $lieux = $lieuxRepository->findAll();

        return $this->json($lieux);
    }

    /**
     * @Route("/api/usager/{id}", name="show_usager", methods={"GET","HEAD"})
     */
    public function show(LieuxRepository $lieuxRepository, int $id): JsonResponse
    {
        $lieux = $lieuxRepository->find($id);
        return $this->json($lieux);
    }
}
