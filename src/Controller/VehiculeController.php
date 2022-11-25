<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VehiculeRepository;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Vehicule;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\HeaderUtils;

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
     * @Route("/api/vehicule/{num_acc}", name="searchByNum_Acc_vehicule", methods={"GET","HEAD"})
     */
    public function searchByNum_Acc(VehiculeRepository $vehiculeRepository, string $num_acc): JsonResponse
    {
        $data = $vehiculeRepository->findByNum_Acc($num_acc);

        return $this->json($data);
    }


    /**
     * @Route("/api/vehicule/{num_acc}", name="new_vehicules", methods={"POST","HEAD"})
     */
    public function new(Request $request, SluggerInterface $slugger, VehiculeRepository $vehiculeRepository): JsonResponse
    {
        if (!$request->files->get('vehicules')) {
            return new JsonResponse('To big!', 400);
        } else {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $request->files->get('vehicules');
            $fileSize = $uploadedFile->getSize();
            if ($fileSize > 10000000) {
                return $this->json(['error' => 'File size too large']);
            } else {
                $destination = $this->getParameter('kernel.project_dir') . '/public/uploads';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);

                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                // get file size
                $newFilename = $safeFilename . '-' . uniqid() . '.csv';
                $uploadedFile->move($destination, $newFilename);

                $fileData = fopen($destination . '/' . $newFilename, 'r', true);
                $vehicules = [];
                $i = 0;
                // count lines in csv file
                while (!feof($fileData)) {
                    $vehicule = new Vehicule();

                    $line = fgetcsv($fileData, 0, ';');
                    $vehicule->setNumAcc($line[0]);
                    $vehicule->setIdVehicule($line[1]);
                    $vehicule->setNumVeh($line[2]);
                    $vehicule->setSenc($line[3]);
                    $vehicule->setCatv($line[4]);
                    $vehicule->setObs($line[5]);
                    $vehicule->setObsm($line[6]);
                    $vehicule->setChoc($line[7]);
                    $vehicule->setManv($line[8]);
                    $vehicule->setMotor($line[9]);
                    $vehicule->setOccutc($line[10]);
                    // append vehicule to vehicules array
                    $vehicules[$i] = $vehicule;
                    $i++;
                }

                fclose($fileData);


                $data = $vehiculeRepository->insertVehicules($vehicules);
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
     * @Route("/api/vehicules/paginated/{row_index}", name="getPaginatedReccords", methods={"POST","HEAD"})
     */
    public function getPaginatedReccords(VehiculeRepository $vehiculeRepository, int $row_index): JsonResponse
    {
        $data = $vehiculeRepository->getPaginatedRecords($row_index);
        return $this->json($data);
    }
    /**
     * @Route("/api/vehicules/paginated_csv/{row_index}", name="getPaginatedReccordsCsv", methods={"POST","HEAD"})
     */
    public function getPaginatedReccordsCsv(vehiculeRepository $vehiculeRepository, int $row_index): Response
    {
        $encoders = [new CsvEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $data = $vehiculeRepository->getPaginatedRecords($row_index);

        $fileContent = $serializer->serialize($data, 'csv'); // the generated file content


        $response = new Response($fileContent);

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            'vehicules.csv'
        );
        $response->headers->set('Content-Disposition', $disposition);
        return $response;
    }
    /**
     * @Route("/api/vehicules/paginated_json/{row_index}", name="getPaginatedReccordsJson", methods={"POST","HEAD"})
     */
    public function getPaginatedReccordsJson(VehiculeRepository $vehiculeRepository, int $row_index): Response
    {


        $data = $vehiculeRepository->getPaginatedRecords($row_index);

        $fileContent = $this->json($data); // the generated file content
        $response = new Response($fileContent);

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            'vehicules.json'
        );
        $response->headers->set('Content-Disposition', $disposition);
        return $response;
    }
}
