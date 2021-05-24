<?php

namespace App\Controller;

use App\Entity\Subsidios;
use App\Repository\SubsidiosRepository;
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


    /**
     * @Route("/consultarSubsidios", name="consultarSubsidios", methods = {"GET"})
     * 
     */
    public function consultarSubsidios(Request $request, SubsidiosRepository $subsidiosRepository): JsonResponse
    {   
        
        try {
            $serializer = $this->get('serializer');
            $data = $serializer->serialize($subsidiosRepository->findAll(), 'json');

            return new JsonResponse(json_decode($data, true), Response::HTTP_OK);

        } catch (Exception $error) {
            return new JsonResponse("No se pudo consultar los subsidio\nerror: ".$error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/consultarSubsidiosById", name="consultarSubsidiosById", methods = {"GET"})
     * 
     */
    public function consultarSubsidiosById(Request $request, SubsidiosRepository $subsidiosRepository): JsonResponse
    {   
        
        try {
            $serializer = $this->get('serializer');
            $id = $request->query->get('id');

            $subsidios = $subsidiosRepository->find($id);
            if(! $subsidios){
                return new JsonResponse("no hay un subsidio con este id", Response::HTTP_OK);
            }else{
                $data = $serializer->serialize($subsidiosRepository->find($id), 'json');

                return new JsonResponse(json_decode($data, true), Response::HTTP_OK);
            }

        } catch (Exception $error) {
            return new JsonResponse("No se pudo consultar el subsidio\nerror: ".$error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/getContSusidiosStat", name="getContSusidiosStat", methods = {"GET"})
     * 
     */

    public function getContSusidiosStat(EntityManagerInterface $em, SubsidiosServices $ss ){
        return $ss->getContSusidiosStat($em);
    }


}
