<?php

namespace App\Controller;

use \Doctrine\ORM\EntityManager;
use App\Repository\TiposDocumentoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Registry;


class TiposDocumentoController extends AbstractController{

    /**
     * @Route("/getTiposDocumento", name="getAllTiposDocumento", methods = {"GET"})
     * 
     */    
    public function getTiposDocumento(Request $request, TiposDocumentoRepository $tiposDocumentoRepository):JsonResponse {

        $tipoDocumentos = $tiposDocumentoRepository->getAllTiposDocumento();

        return new JsonResponse($tipoDocumentos, Response::HTTP_OK);

    }
 
}



