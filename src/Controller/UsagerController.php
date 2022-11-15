<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UsagersRepository;
use App\Entity\Usagers;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class UsagerController extends AbstractController
{
    /**
     * @Route("/usager", name="app_usager")
     */
    public function list(UsagersRepository $usagersRepository): JsonResponse
    {
        $usagers = $usagersRepository->findAll();
        // $data = $serializer->serialize($usagers, 'json', ['groups' => 'usager:read']);

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
