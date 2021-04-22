<?php

namespace App\Controller;

use \Doctrine\ORM\EntityManager;
use App\Repository\GenerosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Registry;


class GenerosController extends AbstractController{

    /**
     * @Route("/getGeneros", name="getAllGeneros", methods = {"GET"})
     * 
     */    
    public function getGeneros(Request $request, GenerosRepository $generosRepository):JsonResponse {

        $generos = $generosRepository->getAllGeneros();

        return new JsonResponse($generos, Response::HTTP_OK);

    }
 
}



