<?php

namespace App\Controller;

use \Doctrine\ORM\EntityManager;
use App\Repository\NotificacionesRepository;
use App\Repository\NotiSoliRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Exception;
use Symfony\Component\Validator\Constraints\Json;

class NotiSoliController extends AbstractController{



    /**
     * @Route("/notiSoliPorId", name="notiSoliPorId", methods = {"GET"})
     * 
     */    
    public function notiSoliPorId(Request $request, NotiSoliRepository $notiSoliRepository):JsonResponse {

        try {
            
            $id = $request->query->get('id');

            $noti = $notiSoliRepository->find($id);

            if(!$noti){
                return new JsonResponse( "NO hay notificaciones con el id : $id" , Response::HTTP_BAD_GATEWAY);
            }else{
                $data = $this->get('serializer')->serialize($noti, 'json');

                return new JsonResponse(json_decode($data, true), Response::HTTP_OK);
            }


        } catch (Exception $error) {
            return new JsonResponse("error : $error", Response::HTTP_BAD_GATEWAY);
        }        

    }

}