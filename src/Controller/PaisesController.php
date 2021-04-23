<?php

namespace App\Controller;

use \Doctrine\ORM\EntityManager;
use App\Repository\PaisesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Registry;


class PaisesController extends AbstractController{

    /**
     * @Route("/getPaises", name="getAllPaises", methods = {"GET"})
     * 
     */    
    public function getPaises(Request $request, PaisesRepository $paisesRepository):JsonResponse {

        $paises = $paisesRepository->getAllPaises();

        return new JsonResponse($paises, Response::HTTP_OK);

    }
 
}



