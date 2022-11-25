<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LieuxRepository;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Lieux;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\HeaderUtils;

class LieuxController extends AbstractController
{
    /**
     * @Route("/lieu", name="app_usager")
     */
    public function list(LieuxRepository $lieuxRepository): JsonResponse
    {
        $lieux = $lieuxRepository->findAll();

        return $this->json($lieux);
    }

    /**
     * @Route("/api/lieu/{id}", name="show_usager", methods={"GET","HEAD"})
     */
    public function show(LieuxRepository $lieuxRepository, int $id): JsonResponse
    {
        $lieux = $lieuxRepository->find($id);
        return $this->json($lieux);
    }

    /**
     * @Route("/api/lieux/{num_acc}", name="searchByNum_Acc_lieux", methods={"GET","HEAD"})
     */
    public function searchByNum_Acc(LieuxRepository $lieuxRepository, string $num_acc): JsonResponse
    {
        $data = $lieuxRepository->findByNum_Acc($num_acc);
        return $this->json($data);
    }
    /**
     * @Route("/lieux/new", name="new_lieux", methods={"POST","HEAD"})
     */
    public function new(Request $request, SluggerInterface $slugger, LieuxRepository $lieuxRepository): JsonResponse
    {
        if (!$request->files->get('lieux')) {
            return new JsonResponse('to big', 400);
        } else {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $request->files->get('lieux');
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
                $lieux = [];
                $i = 0;
                while (!feof($fileData)) {
                    $lieu = new Lieux();

                    $line = fgetcsv($fileData, 0, ';');
                    $lieu->setNumAcc($line[0]);
                    $lieu->setCatr($line[1]);
                    $lieu->setVoie($line[2]);
                    $lieu->setV1($line[3]);
                    $lieu->setV2($line[4]);
                    $lieu->setCirc($line[5]);
                    $lieu->setNbv($line[6]);
                    $lieu->setVosp($line[7]);
                    $lieu->setProf($line[8]);
                    $lieu->setPr($line[9]);
                    $lieu->setPr1($line[10]);
                    $lieu->setPlan($line[11]);
                    $lieu->setLartpc($line[12]);
                    $lieu->setLarrout($line[13]);
                    $lieu->setSurf($line[14]);
                    $lieu->setInfra($line[15]);
                    $lieu->setSitu($line[16]);
                    $lieu->setVma($line[17]);
                    $lieux[$i] = $lieu;
                    $i++;
                }

                fclose($fileData);

                $data = $lieuxRepository->insertLieux($lieux);
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
     * @Route("/api/lieux/paginated/{row_index}", name="getPaginatedReccords", methods={"POST","HEAD"})
     */
    public function getPaginatedReccords(LieuxRepository $lieuxRepository, int $row_index): JsonResponse
    {
        $data = $lieuxRepository->getPaginatedRecords($row_index);
        return $this->json($data);
    }
    /**
     * @Route("/api/lieux/paginated_csv/{row_index}", name="getPaginatedReccordsCsv", methods={"POST","HEAD"})
     */
    public function getPaginatedReccordsCsv(LieuxRepository $lieuxRepository, int $row_index): Response
    {
        $encoders = [new CsvEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $data = $lieuxRepository->getPaginatedRecords($row_index);

        $fileContent = $serializer->serialize($data, 'csv'); // the generated file content


        $response = new Response($fileContent);

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            'lieux.csv'
        );
        $response->headers->set('Content-Disposition', $disposition);
        return $response;
    }
    /**
     * @Route("/api/usagers/paginated_json/{row_index}", name="getPaginatedReccordsJson", methods={"POST","HEAD"})
     */
    public function getPaginatedReccordsJson(LieuxRepository $lieuxRepository, Request $request, int $row_index): Response
    {

        $data = $lieuxRepository->getPaginatedRecords($row_index);

        $fileContent = $this->json($data); // the generated file content
        $response = new Response($fileContent);

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            'lieux.json'
        );
        $response->headers->set('Content-Disposition', $disposition);
        return $response;
    }
}
