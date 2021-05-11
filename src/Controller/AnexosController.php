<?php

namespace App\Controller;


use App\Services\AnexosService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class AnexosController extends AbstractController
{

    /**
     *  @Route("/registrarAnexo",name="registrarFromulario", methods = {"POST"} )
     */

    public function registrarAnexo(Request $request, EntityManagerInterface $em, AnexosService $as, ParameterBagInterface $params)
    {
        try {            
            return $as->registrarAnexo($request, $em, $params->get('evidencias_directory'));
        } catch (Exception $error) {
            return new JsonResponse("No se pudo registrar el anexo\nerror: {$error->getMessage()}", Response::HTTP_BAD_GATEWAY);
        }
    }

    /**
     *  @Route("/actualizarAnexo",name="actualizarAnexo", methods = {"PUT"} )
     */

    public function actualizarAnexo(Request $request, EntityManagerInterface $em,AnexosService $as)
    {
        try {
            $requestDats = json_decode($request->getContent(), true);
            return $as->actualizarAnexo($requestDats, $em);
        } catch (Exception $error) {
            return  new JsonResponse("No se pudo actualizar el anexo\nerror: {$error->getMessage()}", Response::HTTP_BAD_GATEWAY);
        }
    }


    /**
     *  @Route("/getAnexosPorIdSubsidio",name="getAnexosPorIdSubsidio", methods = {"GET"} )
     */

    public function getAnexosPorIdSubsidio(Request $request, EntityManagerInterface $em, AnexosService $as)
    {
        try {
            $serializer = $this->get('serializer');
            $idSubsidio = $request->query->get('idSubsidio');
            return $as->getAnexosPorIdSubsidio($idSubsidio, $em, $serializer);
        } catch (Exception $error) {
            return new JsonResponse("No se pudo devolver el anexo\nerror: {$error->getMessage()}", Response::HTTP_BAD_GATEWAY);
        }
    }
}
