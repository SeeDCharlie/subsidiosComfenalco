<?php

namespace App\Controller;

use \Doctrine\ORM\EntityManager;
use App\Repository\DepartamentosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Registry;


class CiudadesController extends AbstractController{

    /**
     * @Route("/getDepartamentos", name="getAllDepartamentos", methods = {"GET"})
     * 
     */    
    public function getDepartamentos(Request $request, DepartamentosRepository $departamentosRepository):JsonResponse {

        $departamentos = $departamentosRepository->getAllDepartamentos();

        return new JsonResponse($departamentos, Response::HTTP_OK);

    }
 
}



