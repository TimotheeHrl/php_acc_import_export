<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AccidentRepository;
use App\Repository\CaracteristiqueRepository;
use App\Repository\LieuxRepository;
use App\Repository\UsagersRepository;
use App\Repository\VehiculeRepository;
use App\Entity\Caracteristique;


class AccidentController extends AbstractController
{
    /**
     * @Route("/accident", name="app_usager")
     */
    public function getAccidentJsonFile(
        CaracteristiqueRepository $caracteristiqueRepository,
        LieuxRepository $lieuxRepository,
        UsagersRepository $usagersRepository,
        VehiculeRepository $vehiculeRepository,
        string $num_Acc
    ): JsonResponse {
        $Accident = [];

        $caracteristiques = $caracteristiqueRepository->findByNum_Acc($num_Acc);
        $lieux = $lieuxRepository->findByNum_Acc($num_Acc);
        $usagers = $usagersRepository->findByNum_Acc($num_Acc);
        $vehicules = $vehiculeRepository->findByNum_Acc($num_Acc);

        $Accident['caracteristiques'] = $caracteristiques;
        $Accident['lieux'] = $lieux;
        $Accident['usagers'] = $usagers;
        $Accident['vehicules'] = $vehicules;


        return $this->json($Accident);
    }
}
