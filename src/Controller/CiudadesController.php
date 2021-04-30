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

class CiudadesController extends AbstractController{

    /**
     * @Route("/getCiudadesByDepartamento", name="getCiudadesByDepartamento", methods = {"GET"})
     * 
     */    
    public function getCiudadesByDepartamento(Request $request, CiudadesRepository $ciudadesRepository, DepartamentosRepository $depRepository):JsonResponse {

        try {
            $response = new JsonResponse();
            
            $departamento = $request->query->get('departamento');

            $serializer = $this->get('serializer');
            $dep = $depRepository->findOneByDepartamento($departamento);

            if($dep == null){
                $response->setData(['success' => true, 'msj' => "el departamento con el nombre : $departamento no existe"]);
                return $response;
            }else{
                $ciudades = $serializer->serialize($ciudadesRepository->findByIdDepartamento($dep->getIdDepartamento()), 'json');
            
                $response->setData(['ciudades' => json_decode($ciudades, true)], Response::HTTP_OK);
                return $response;
            }
        } catch (Exception $error) {
            $response->setData(['success' => false, 'msj' => "error: {$error->getMessage()}"]);
            return $response;
        }
    }

    /**
     * @Route("/getCiudades", name="getAllCiudades", methods = {"GET"})
     * 
     */    
    public function getCiudades(Request $request, CiudadesRepository $ciudadesRepository):JsonResponse {

        $ciudades = $ciudadesRepository->getAllCiudades();

        return new JsonResponse($ciudades, Response::HTTP_OK);

    }
 
}



