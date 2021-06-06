<?php

namespace App\Controller;

use \Doctrine\ORM\EntityManager;
use App\Repository\NotificacionesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Exception;
use Symfony\Component\Validator\Constraints\Json;

class NotificacionesController extends AbstractController{

    /**
     * @Route("/notiPorId", name="notiPorId", methods = {"GET"})
     * 
     */    
    public function notiPorId(Request $request, NotificacionesRepository $notiRepository):JsonResponse {

        try {
            
            $idNoti = $request->query->get('idNoti');

            $noti = $notiRepository->find($idNoti);

            if(!$noti){
                return new JsonResponse( "NO hay notificaciones con el id : $idNoti" , Response::HTTP_BAD_GATEWAY);
            }else{
                $data = $this->get('serializer')->serialize($noti, 'json');

                return new JsonResponse(json_decode($data, true), Response::HTTP_OK);
            }


        } catch (Exception $error) {
            return new JsonResponse("error : $error", Response::HTTP_BAD_GATEWAY);
        }        

    }

    /**
     * @Route("/notiPorNombre", name="notiPorNombre", methods = {"GET"})
     * 
     */    
    public function notiPorNombre(Request $request, NotificacionesRepository $notiRepository):JsonResponse {

        try {
            
            $notificacion = $request->query->get('notificacion');

            $noti = $notiRepository->findByNotificacion($notificacion);

            if(!$noti){
                return new JsonResponse( "NO hay notificaciones con el nombre : $notificacion" , Response::HTTP_BAD_GATEWAY);
            }else{
                $data = $this->get('serializer')->serialize($noti, 'json');

                return new JsonResponse(json_decode($data, true), Response::HTTP_OK);
            }


        } catch (Exception $error) {
            return new JsonResponse("error : $error", Response::HTTP_BAD_GATEWAY);
        }        

    }
 
}