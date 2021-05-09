<?php

namespace App\Controller;

use \Doctrine\ORM\EntityManager;
use App\Repository\ProgramasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Exception;

class ProgramasController extends AbstractController{

    /**
     *  @Route("/programas",name="programas", methods = {"GET"})
     */
    public function getAllProgramas(Request $request, ProgramasRepository $programasRepository): JsonResponse {

        $programDatas = $programasRepository->getProgramasSQL();
        
        return new JsonResponse($programDatas, Response::HTTP_OK);

    }

    /**
     *  @Route("/programasPorId",name="programasPorId", methods = {"GET"})
     */
    public function programasPorId(Request $request, ProgramasRepository $programasRepository): JsonResponse {

        try {

            $idPrograma = $request->query->get('idPrograma');

            $serializer = $this->get('serializer');

            $programa = $programasRepository->findByIdPrograma($idPrograma);

            if (!$programa) {
                return new JsonResponse("Id programa incorrecto", Response::HTTP_CONFLICT);
            } else {
                $data = $serializer->serialize($programa, 'json');

                return new JsonResponse(json_decode($data, true), Response::HTTP_OK);
            }
        } catch (Exception $error) {
            return new JsonResponse(['success' => false, 'msj' => "error: {$error->getMessage()}"], Response::HTTP_NOT_FOUND);
        }

    }



}



