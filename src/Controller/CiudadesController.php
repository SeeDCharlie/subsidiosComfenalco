<?php

namespace App\Controller;

use \Doctrine\ORM\EntityManager;
use App\Repository\CiudadesRepository;
use App\Repository\DepartamentosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Exception;
use Symfony\Component\Validator\Constraints\Json;

class CiudadesController extends AbstractController
{

    /**
     * @Route("/getCiudadesByDepartamento", name="getCiudadesByDepartamento", methods = {"GET"})
     * 
     */
    public function getCiudadesByDepartamento(Request $request, CiudadesRepository $ciudadesRepository, DepartamentosRepository $depRepository): JsonResponse
    {

        try {
            $departamento = $request->query->get('departamento');

            $serializer = $this->get('serializer');
            $dep = $depRepository->findOneByDepartamento($departamento);

            if ($dep == null) {
                return new JsonResponse("el departamento con el nombre : $departamento no existe", Response::HTTP_OK);
            } else {
                $ciudades = $serializer->serialize($ciudadesRepository->findByIdDepartamento($dep->getIdDepartamento()), 'json');
                return new JsonResponse(json_decode($ciudades, true), Response::HTTP_OK);
            }
        } catch (Exception $error) {
            return new JsonResponse("error: {$error->getMessage()}", Response::HTTP_BAD_GATEWAY);
        }
    }

    /**
     * @Route("/getCiudades", name="getAllCiudades", methods = {"GET"})
     * 
     */
    public function getCiudades(Request $request, CiudadesRepository $ciudadesRepository): JsonResponse
    {
        try {
            $ciudades = $ciudadesRepository->getAllCiudades();

            return new JsonResponse($ciudades, Response::HTTP_OK);
        } catch (Exception $error) {
            return new JsonResponse("error: {$error->getMessage()}", Response::HTTP_BAD_GATEWAY);
        }
    }
}
