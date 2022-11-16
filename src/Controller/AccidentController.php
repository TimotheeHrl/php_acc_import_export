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
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

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
        string $num_Acc
    ): Response {
        $accident = [];

        $caracteristiques = $caracteristiqueRepository->findByNum_Acc($num_Acc);
        $lieux = $lieuxRepository->findByNum_Acc($num_Acc);
        $usagers = $usagersRepository->findByNum_Acc($num_Acc);
        $vehicules = $vehiculeRepository->findByNum_Acc($num_Acc);

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
     * @Route("/accident/{num_Acc}", name="Accident_File_Csv")
     */
    public function getAccidentCsvFile(
        CaracteristiqueRepository $caracteristiqueRepository,
        LieuxRepository $lieuxRepository,
        UsagersRepository $usagersRepository,
        VehiculeRepository $vehiculeRepository,
        string $num_Acc
    ): Response {
        $accident = [];

        $caracteristiques = $caracteristiqueRepository->findByNum_Acc($num_Acc);
        $lieux = $lieuxRepository->findByNum_Acc($num_Acc);
        $usagers = $usagersRepository->findByNum_Acc($num_Acc);
        $vehicules = $vehiculeRepository->findByNum_Acc($num_Acc);

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
}
