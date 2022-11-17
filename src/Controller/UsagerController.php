<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UsagersRepository;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Usagers;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\HeaderUtils;

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


    /**
     * @Route("/api/lieux/{num_Acc}", name="searchByNum_Acc_usagers", methods={"GET","HEAD"})
     */
    public function searchByNum_Acc(UsagersRepository $usagersRepository, string $num_Acc): JsonResponse
    {
        $data = $usagersRepository->findByNum_Acc($num_Acc);
        return $this->json($data);
    }


    /**
     * @Route("/usagers/new", name="new_usagers", methods={"POST","HEAD"})
     */
    public function new(Request $request, SluggerInterface $slugger, UsagersRepository $usagersRepository): JsonResponse
    {
        if (!$request->files->get('usagers')) {
            return new JsonResponse('to big', 400);
        } else {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $request->files->get('usagers');
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
                $usagers = [];
                $i = 0;
                while (!feof($fileData)) {
                    $usager = new Usagers();

                    $line = fgetcsv($fileData, 0, ';');

                    $usager->setNumAcc($line[0]);
                    $usager->setIdVehicule($line[1]);
                    $usager->setNumVeh($line[2]);
                    $usager->setPlace($line[3]);
                    $usager->setCatu($line[4]);
                    $usager->setGrav($line[5]);
                    $usager->setSexe($line[6]);
                    $usager->setAnNais($line[7]);
                    $usager->setTrajet($line[8]);
                    $usager->setSecu1($line[9]);
                    $usager->setSecu2($line[10]);
                    $usager->setSecu3($line[11]);
                    $usager->setLocp($line[12]);
                    $usager->setActp($line[13]);
                    $usager->setEtatp($line[14]);


                    $vehicules[$i] = $usager;
                    $i++;
                }

                fclose($fileData);

                $data = $usagersRepository->insertUsagers($usagers);
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
    /**
     * @Route("/api/usagers/paginated/{row_index}", name="getPaginatedReccords", methods={"POST","HEAD"})
     */
    public function getPaginatedReccords(UsagersRepository $usagersRepository, int $row_index): JsonResponse
    {
        $data = $usagersRepository->getPaginatedRecords($row_index);
        return $this->json($data);
    }
    /**
     * @Route("/api/usagers/paginated_csv/{row_index}", name="getPaginatedReccordsCsv", methods={"POST","HEAD"})
     */
    public function getPaginatedReccordsCsv(UsagersRepository $usagersRepository, int $row_index): Response
    {
        $encoders = [new CsvEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $data = $usagersRepository->getPaginatedRecords($row_index);

        $fileContent = $serializer->serialize($data, 'csv'); // the generated file content


        $response = new Response($fileContent);

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            'usagers.csv'
        );
        $response->headers->set('Content-Disposition', $disposition);
        return $response;
    }
    /**
     * @Route("/api/usagers/paginated_json/{row_index}", name="getPaginatedReccordsJson", methods={"POST","HEAD"})
     */
    public function getPaginatedReccordsJson(UsagersRepository $usagersRepository, Request $request, int $row_index): Response
    {

        $data = $usagersRepository->getPaginatedRecords($row_index);

        $fileContent = $this->json($data); // the generated file content
        $response = new Response($fileContent);

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            'usagers.json'
        );
        $response->headers->set('Content-Disposition', $disposition);
        return $response;
    }
}
