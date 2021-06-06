<?php

namespace App\Controller;

use App\Entity\NotiSoli;
use \Doctrine\ORM\EntityManager;
use App\Repository\NotificacionesRepository;
use App\Repository\NotiSoliRepository;
use App\Repository\SubsidiosRepository;
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
     * @Route("/getAllNotiASoli", name="getAllNotiASoli", methods = {"GET"})
     * 
     */    
    public function getAllNotiASoli(Request $request, NotiSoliRepository $notiSoliRepository):JsonResponse {

        try {
            $noti = $notiSoliRepository->findAll();

            if(!$noti){
                return new JsonResponse( "NO hay notificaciones" , Response::HTTP_BAD_GATEWAY);
            }else{
                $data = $this->get('serializer')->serialize($noti, 'json');

                return new JsonResponse(json_decode($data, true), Response::HTTP_OK);
            }
        } catch (Exception $error) {
            return new JsonResponse("error : $error", Response::HTTP_BAD_GATEWAY);
        }        

    }


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

      /**
     * @Route("/guardarNotiSoli", name="guardarNotiSoli", methods = {"POST"})
     * 
     */    
    public function guardarNotiSoli(Request $request, EntityManagerInterface $em, SubsidiosRepository $subRepository, NotificacionesRepository $notifRepository, NotiSoliRepository $notiSoliRepository):JsonResponse {

        try {
            $dats = json_decode($request->getContent(), true);

            $noti = $notifRepository->find($dats['idNoti']);
            $subsidio = $subRepository->find($dats['idSubsidio']);

            if(!$noti){
                return new JsonResponse( "NO hay notificaciones con el id : ".$dats['idNoti'] , Response::HTTP_BAD_GATEWAY);
            }
            if(!$subsidio){
                return new JsonResponse( "NO hay subsidios con el id : ".$dats['idSubsidio'] , Response::HTTP_BAD_GATEWAY);
            }
            if(empty($dats['mensaje'])){
                return new JsonResponse( "NO esta definido el mesaje".$dats['mensaje'] , Response::HTTP_BAD_GATEWAY);
            }


            $noti_soli = new NotiSoli();
            $noti_soli->setIdNotificacion($dats['idNoti']);
            $noti_soli->setIdSubsidios($dats['idSubsidio']);
            $noti_soli->setMensaje($dats['mensaje']);

            $em->persist($noti_soli);
            $em->flush();


            return new JsonResponse("noti soli guardada", Response::HTTP_OK);
            
        } catch (Exception $error) {
            return new JsonResponse("error : $error", Response::HTTP_BAD_GATEWAY);
        }        

    }

}