<?php

namespace App\Controller;

use App\Entity\ProgramaRequerimientos;
use App\Entity\Programas;
use App\Repository\ProgramaRequerimientosRepository;
use App\Services\AnexosService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class ProgramaRequerimientosController extends AbstractController
{

    /**
     *  @Route("/getAllProgramaRequerimientos",name="getAllProgramaRequerimientos", methods = {"GET"} )
     */

    public function getAllProgramaRequerimientos(ProgramaRequerimientosRepository $requerimientosRepository)
    {
        try {

            $serializer = $this->get('serializer');

            $requerimientos = $requerimientosRepository->findAll();

            if (!$requerimientos) {
                return new JsonResponse("NO hay requerimientos registrados", Response::HTTP_BAD_GATEWAY);
            } else {
                $data = $serializer->serialize($requerimientos, 'json');
                return new JsonResponse(json_decode($data, true), Response::HTTP_OK);
            }
        } catch (Exception $error) {
            return new JsonResponse("Error inesperado : " . $error->getMessage());
        }
    }

    /**
     *  @Route("/getRequerimietosPorPrograma",name="getRequerimietosPorPrograma", methods = {"GET"} )
     */

    public function getRequerimietosPorPrograma(Request $request, EntityManagerInterface $em)
    {
        try {

            $serializer = $this->get('serializer');
            $idPprograma = $request->query->get('idPprograma');

            $programa = $em->getRepository(Programas::class)->find($idPprograma);

            if (!$programa) {
                return new JsonResponse("Programa no valido", Response::HTTP_BAD_GATEWAY);
            } else {
                $requerimientos = $em->getRepository(ProgramaRequerimientos::class)->findByIdPrograma($idPprograma);

                if (!$requerimientos) {
                    return new JsonResponse("NO hay requerimientos registrados", Response::HTTP_BAD_GATEWAY);
                } else {
                    $data = $serializer->serialize($requerimientos, 'json');
                    return new JsonResponse(json_decode($data, true), Response::HTTP_OK);
                }
            }
        } catch (Exception $error) {
            return new JsonResponse("Error inesperado : " . $error->getMessage());
        }
    }
}
