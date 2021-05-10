<?php

namespace App\Controller;

use App\Entity\Subsidios;
use App\Services\SubsidiosServices;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class SubsidiosController extends AbstractController
{

    /**
     * @Route("/registrarSubsidio", name="registrarSubsidio", methods = {"POST"})
     */


    public function regisSubsidio(Request $request, EntityManagerInterface $em, SubsidiosServices $ss, ParameterBagInterface $params)
    {
        try {
            
            return $ss->registrarSubsidio( $request , $em, $params->get('forms_directory'));
        } catch (Exception $error) {
            return new JsonResponse("No se pudo registrar la solicitud de subsidio\nerror: ".$error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/actualizarSubsidio", name="actualizarSubsidio", methods = {"PUT"} )
     */


    public function actualizarSubsidio(Request $request,  SubsidiosServices $ss, EntityManagerInterface $em)
    {
        try {
            $dats = json_decode($request->getContent(), true);
            return $ss->actualizarSubsidio($dats, $em);
        } catch (Exception $error) {
            return new JsonResponse("No se pudo actualizar la solicitud de subsidio\nerror: ".$error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }


    


}
