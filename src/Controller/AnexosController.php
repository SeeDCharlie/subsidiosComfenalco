<?php

namespace App\Controller;

use App\Repository\ProgramaRequerimientosRepository;
use \Doctrine\ORM\EntityManager;
use App\Repository\ProgramasRepository;
use App\Repository\SubsidiosRepository;
use App\Services\AnexosService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class AnexosController extends AbstractController
{

    /**
     *  @Route("/registrarAnexo",name="registrarFromulario", methods = {"POST"} )
     */

    public function registrarAnexo(Request $request, EntityManagerInterface $em, AnexosService $as)
    {
        $response = new JsonResponse();
        try {
            $requestDats = json_decode($request->getContent(), true);
            return $as->registrarAnexo($requestDats, $em);
        } catch (Exception $error) {
            $response->setData(['success' => false, 'msj' => "No se pudo registrar el anexo\nerror: {$error->getMessage()}"]);
            return $response;
        }

        
       
    }
}
