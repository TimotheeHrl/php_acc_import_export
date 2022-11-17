<?php

namespace App\Controller;

use App\Form\VehiculeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VehiculeRepository;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Vehicule;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
     * @Route("/api/vehicule/{num_Acc}", name="searchByNum_Acc_vehicule", methods={"GET","HEAD"})
     */
    public function searchByNum_Acc(VehiculeRepository $vehiculeRepository, string $num_Acc): JsonResponse
    {
        $data = $vehiculeRepository->findByNum_Acc($num_Acc);
        return $this->json($data);
    }


    // method post that parse csv file and insert data into database&
    /**
     * @Route("/api/vehicule/{num_Acc}", name="searchByNum_Acc_vehicule", methods={"GET","HEAD"})
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        if (!$request->files->get('veh')) {
            return new Response('No file uploaded', 400);
        } else {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $request->files->get('veh');
            $destination = $this->getParameter('kernel.project_dir') . '/public/uploads';
            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);

            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);

            $newFilename = $safeFilename . '-' . uniqid() . '.csv';
            $uploadedFile->move($destination, $newFilename);

            $fileData = fopen($destination . '/' . $newFilename, 'r', true);
            // parse csv 


            $i = 0;
            // count lines in csv file
            while (!feof($fileData)) {
                $line = fgetcsv($fileData, 0, ';');
                dd($line);
                $i++;
            }

            fclose($fileData);




            return new Response("ss", 200);
        }
    }
}
