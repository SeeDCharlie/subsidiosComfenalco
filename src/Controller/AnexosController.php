<?php

namespace App\Controller;


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

    /**
     *  @Route("/actualizarAnexo",name="actualizarAnexo", methods = {"PUT"} )
     */

    public function actualizarAnexo(Request $request, EntityManagerInterface $em, AnexosService $as)
    {
        $response = new JsonResponse();
        
        try {
            $requestDats = json_decode($request->getContent(), true);
            return $as->actualizarAnexo($requestDats, $em);
        } catch (Exception $error) {
            $response->setData(['success' => false, 'msj' => "No se pudo devolver la lista de anexo\nerror: {$error->getMessage()}"]);
            return $response;
        }
    }


    /**
     *  @Route("/getAnexosPorIdSubsidio",name="getAnexosPorIdSubsidio", methods = {"GET"} )
     */

    public function getAnexosPorIdSubsidio(Request $request, EntityManagerInterface $em, AnexosService $as)
    {
        $response = new JsonResponse();
        
        try {

            $serializer = $this->get('serializer');
            $idSubsidio = $request->query->get('idSubsidio');
            return $as->getAnexosPorIdSubsidio($idSubsidio, $em, $serializer);
        } catch (Exception $error) {
            $response->setData(['success' => false, 'msj' => "No se pudo devolver la lista de anexos\nerror: {$error->getMessage()}"]);
            return $response;
        }
    }

}
