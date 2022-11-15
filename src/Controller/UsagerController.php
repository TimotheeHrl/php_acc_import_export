<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UsagersRepository;


class UsagerController extends AbstractController
{
    /**
     * @Route("/usager", name="app_usager")
     */
    public function list(UsagersRepository $usagersRepository): JsonResponse
    {
        $usagers = $usagersRepository->findAll();

        return $this->json($usagers);
    }

    /**
     * @Route("/api/usager/{id}", name="show_usager", methods={"GET","HEAD"})
     */
    public function show(UsagersRepository $usagersRepository, int $id): JsonResponse
    {
        $usager = $usagersRepository->find($id);
        return $this->json($usager);
    }
}
