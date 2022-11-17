<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CaracteristiqueRepository;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Caracteristique;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\HeaderUtils;


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

    /**
     * @Route("/api/usager/{num_Acc}", name="searchByNum_Acc_caracteristiques", methods={"GET","HEAD"})
     */
    public function searchByNum_Acc(CaracteristiqueRepository $caracteristiqueRepository, string $num_Acc): JsonResponse
    {
        $data = $caracteristiqueRepository->findByNum_Acc($num_Acc);
        return $this->json($data);
    }

    /**
     * @Route("/api/caracteristiques/paginated/{row_index}", name="getPaginatedReccords", methods={"POST","HEAD"})
     */
    public function getPaginatedReccords(CaracteristiqueRepository $caracteristiqueRepository, Request $request, int $row_index): JsonResponse
    {
        $data = $caracteristiqueRepository->getPaginatedRecords($row_index);
        return $this->json($data);
    }

    /**
     * @Route("/api/caracteristiques/paginated_csv/{row_index}", name="getPaginatedReccordsCsv", methods={"POST","HEAD"})
     */
    public function getPaginatedReccordsCsv(CaracteristiqueRepository $caracteristiqueRepository, Request $request, int $row_index): Response
    {
        $encoders = [new CsvEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $data = $caracteristiqueRepository->getPaginatedRecords($row_index);

        $fileContent = $serializer->serialize($data, 'csv'); // the generated file content


        $response = new Response($fileContent);

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            'caracteristiques.csv'
        );
        $response->headers->set('Content-Disposition', $disposition);
        return $response;
    }
    /**
     * @Route("/api/caracteristiques/paginated_json/{row_index}", name="getPaginatedReccordsJson", methods={"POST","HEAD"})
     */
    public function getPaginatedReccordsJson(CaracteristiqueRepository $caracteristiqueRepository, Request $request, int $row_index): Response
    {
        $encoders = [new CsvEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $data = $caracteristiqueRepository->getPaginatedRecords($row_index);

        $fileContent = $this->json($data); // the generated file content
        $response = new Response($fileContent);

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            'caracteristiques.json'
        );
        $response->headers->set('Content-Disposition', $disposition);
        return $response;
    }

    /**
     * @Route("/api/caracteristiques/{num_Acc}", name="new_usagers", methods={"POST","HEAD"})
     */
    public function new(Request $request, SluggerInterface $slugger, CaracteristiqueRepository $caracteristiqueRepository): JsonResponse
    {
        if (!$request->files->get('caracteristiques')) {
            return new JsonResponse('to big', 400);
        } else {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $request->files->get('caracteristiques');
            $fileSize = $uploadedFile->getSize();
            if ($fileSize > 10000000) {
                return $this->json(['error' => 'File size too large']);
            } else {
                $destination = $this->getParameter('kernel.project_dir') . '/public/uploads';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.csv';
                $uploadedFile->move($destination, $newFilename);

                $fileData = fopen($destination . '/' . $newFilename, 'r', true);
                $caracteristiques = [];
                $i = 0;
                while (!feof($fileData)) {
                    $caracteristique = new Caracteristique();

                    $line = fgetcsv($fileData, 0, ';');
                    $caracteristique->setNumAcc($line[0]);
                    $caracteristique->setJour($line[1]);
                    $caracteristique->setMois($line[2]);
                    $caracteristique->setAn($line[3]);
                    $caracteristique->setHrmn($line[4]);
                    $caracteristique->setLum($line[5]);
                    $caracteristique->setDep($line[6]);
                    $caracteristique->setCom($line[7]);
                    $caracteristique->setAgg($line[8]);
                    $caracteristique->setInte($line[9]);
                    $caracteristique->setAtm($line[10]);
                    $caracteristique->setCol($line[11]);
                    $caracteristique->setAdr($line[12]);
                    $caracteristique->setLat($line[13]);
                    $caracteristique->setLongi($line[14]);


                    $caracteristiques[$i] = $caracteristique;
                    $i++;
                }

                fclose($fileData);

                $data = $caracteristiqueRepository->insertCaracteristiques($caracteristiques);
                // delete file 
                if (!unlink($destination . '/' . $newFilename)) {
                    echo ("$destination/$newFilename . cannot be deleted due to an error");
                } else {
                    echo ("$destination/$newFilename. has been deleted");
                }
                return $this->json($data);
            }
        }
    }
}
