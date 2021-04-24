<?php

namespace App\Services;

use App\Entity\Anexos;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;



class AnexosService
{

    public function resgistrarAnexo($dats, $em)
    {

        $response = new JsonResponse();
        $anexo = new Anexos();

        try {
            
            $anexo->setEstado($dats['estado']);
            $anexo->setObservaciones($dats['observaciones']);
            $anexo->setIdSubsidios($dats['id_subsisdio']);
            $anexo->setIdProgReq($dats['idProgReque']);
            $anexo->setDocumento("uploads/evidenciasSubsidio/".$dats['id_subsisdio']."/".$dats['idProgReque']."_".$dats['nameFile']);
            
            $em->persist($anexo);
            $em->flush();

            $response->setData(['success' => true, 'msj' => "anexo registrada exitosamente,id : ".$anexo->getIdAnexo(), 'id'=>$anexo->getIdAnexo()]);
            return $response;
        } catch (Exception $error) {
            $response->setData(['success' => false, 'msj' => "No se pudo registrar el anexo\nerror: {$error->getMessage()}"]);
            return $response;
        }
    }

}
