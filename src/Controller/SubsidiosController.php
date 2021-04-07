<?php

namespace App\Controller;

use App\Entity\Subsidios;
use App\Repository\SubsidiosRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SubsidiosController extends AbstractController
{

    /**
     * @Route("/subsidios",name="subsidios")
     */
    
<<<<<<< HEAD
     
     
    public function regisSubsidio(Request $request, EntityManagerInterface $em) {
        /*
            $response = new JsonResponse();
        $soliSubsidio = new Subsidios();
        if ($request->getMethod() == 'POST') {
            try {
                
                //$estadoSub = $em->find('EstadosSubsidios','1');
                $requestDats = json_decode($request->getContent(), true);

                $soliSubsidio->setIdEstado(1);
                $soliSubsidio->setIdUsuario($requestDats['idUsr'] );
                $soliSubsidio->setIdPrograma($requestDats['idPrograma']);
                $soliSubsidio->setFechaCreacion( new DateTime(date("Y-m-d")) );
                $soliSubsidio->setFechaModificacion( new DateTime(date("Y-m-d"))  );
                $soliSubsidio->setFechaFinalizacion($requestDats['fechaFinalizacion']);
                $soliSubsidio->setFormulario($requestDats['url']);
    
                $em->persist($soliSubsidio);
                $em->flush();
                
                $response->setData(['success' => true, 'msj' => "solicitud registrada exitosamente"]);
                return $response;
            } catch (Exception $error) {
                $response->setData(['success' => false, 'msj' => "No se pudo crear la sulicitud\nerror: {$error->getMessage()}"]);
                return $response;
            }
        } else {
            $response->setData(['success' => false, 'msj' => "Method GET don't response"]);
            return $response;
        }

        */

    }
=======
    // public function consultarSubsidios(Request $request, SubsidiosRepository $subsidiosRepository): JsonResponse{

    //     $subsidios = $subsidiosRepository->findAll();
    //     $subsidiosArray = [];
>>>>>>> 84bb7efd2674953270a6c38cb600f01ba3574af4

    //     foreach ($subsidios as $subsidio) {                        
    //         $subsidiosArray [] = [
    //             'IdSubsidios' => $subsidio->getIdSubsidios(),
    //             'IdEstado' => $subsidio->getIdEstado(),
    //             'IdUsuario' = $subsidio->getId
    //         ]
    //     }

    // }


}
