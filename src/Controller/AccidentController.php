<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CaracteristiqueRepository;
use App\Repository\LieuxRepository;
use App\Repository\UsagersRepository;
use App\Repository\VehiculeRepository;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class AccidentController extends AbstractController
{
    /**
     * @Route("/accident", name="Accident_File_Json")
     */
    public function getAccidentJsonFile(
        CaracteristiqueRepository $caracteristiqueRepository,
        LieuxRepository $lieuxRepository,
        UsagersRepository $usagersRepository,
        VehiculeRepository $vehiculeRepository,
        string $num_acc
    ): Response {
        $accident = [];

        $caracteristiques = $caracteristiqueRepository->findByNum_Acc($num_acc);
        $lieux = $lieuxRepository->findByNum_Acc($num_acc);
        $usagers = $usagersRepository->findByNum_Acc($num_acc);
        $vehicules = $vehiculeRepository->findByNum_Acc($num_acc);

        $accident['caracteristiques'] = $caracteristiques;
        $accident['lieux'] = $lieux;
        $accident['usagers'] = $usagers;
        $accident['vehicules'] = $vehicules;
        $fileContent = $this->json($accident); // the generated file content
        $response = new Response($fileContent);

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            'foo.json'
        );
        $response->headers->set('Content-Disposition', $disposition);
        return $response;
    }

    /**
     * @Route("/accident/", name="Accident_File_Csv")
     */
    public function getAccidentCsvFile(
        CaracteristiqueRepository $caracteristiqueRepository,
        LieuxRepository $lieuxRepository,
        UsagersRepository $usagersRepository,
        VehiculeRepository $vehiculeRepository,
        string $num_acc
    ): Response {
        $accident = [];

        $caracteristiques = $caracteristiqueRepository->findByNum_Acc($num_acc);
        $lieux = $lieuxRepository->findByNum_Acc($num_acc);
        $usagers = $usagersRepository->findByNum_Acc($num_acc);
        $vehicules = $vehiculeRepository->findByNum_Acc($num_acc);

        $accident['caracteristiques'] = $caracteristiques;
        $accident['lieux'] = $lieux;
        $accident['usagers'] = $usagers;
        $accident['vehicules'] = $vehicules;

        $encoders = [new CsvEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $fileContent = $serializer->serialize($accident, 'csv'); // the generated file content


        $response = new Response($fileContent);

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            'foo.csv'
        );
        $response->headers->set('Content-Disposition', $disposition);
        return $response;
    }

    public function getAccidentByNumAcc(
        CaracteristiqueRepository $caracteristiqueRepository,
        LieuxRepository $lieuxRepository,
        UsagersRepository $usagersRepository,
        VehiculeRepository $vehiculeRepository,
        Request $request
    ): JsonResponse {
        $accident = [];
        $num_acc = $request->query->get('num_acc');
        $caracteristiques = $caracteristiqueRepository->findByNum_Acc($num_acc);
        $lieux = $lieuxRepository->findByNum_Acc($num_acc);
        $usagers = $usagersRepository->findByNum_Acc($num_acc);
        $vehicules = $vehiculeRepository->findByNum_Acc($num_acc);

        $accident['caracteristiques'] = $caracteristiques;
        $accident['lieux'] = $lieux;
        $accident['usagers'] = $usagers;
        $accident['vehicules'] = $vehicules;

        return $this->json($accident);
    }
}
