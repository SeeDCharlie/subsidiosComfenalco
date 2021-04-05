<?php

namespace App\Controller;

use App\Repository\ProgramasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProgramasController extends AbstractController{

    public function getAllProgramas(Request $request, ProgramasRepository $programasRepository): JsonResponse{

        $programas = $programasRepository->findAll();
        $programasArray = [];

        foreach ($programas as $programa) {
            $programasArray[] = [
                'programa' => $programa->getPrograma(),
                'infoPrograma' => $programa->getInfoPrograma(),
            ];            
        };

        return new JsonResponse($programasArray, Response::HTTP_OK);


    }

}



