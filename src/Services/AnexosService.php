<?php

namespace App\Services;

use App\Entity\Anexos;
use App\Entity\ProgramaRequerimientos;
use App\Entity\Subsidios;
use App\Repository\SubsidiosRepository;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;



class AnexosService
{
    

    public function registrarAnexo($dats, $em)
    {
  
        $response = new JsonResponse();
        $anexo = new Anexos();

        try {
            
            $subsidio = $em->getRepository(Subsidios::class)->find($dats['id_subsisdio']);
            $requerimiento = $em->getRepository(ProgramaRequerimientos::class)->find($dats['idProgReque']); 
            if($subsidio == null ){
                $response->setData(['success' => false, 'msj' => "El subsidio no existe"]);
            }
            if($requerimiento == null){
                $response->setData(['success' => false, 'msj' => "El requerimiento no existe"]);
            }
            if($subsidio != null && $requerimiento != null){

                $anexo->setEstado($dats['estado']);
                $anexo->setObservaciones($dats['observaciones']);
    
                $anexo->setIdSubsidios($dats['id_subsisdio']);
                $anexo->setIdProgReq($dats['idProgReque']);
                $anexo->setDocumento("uploads/evidenciasSubsidio/".$dats['id_subsisdio']."/".$dats['idProgReque']."_".$dats['nombreArchivo']);
                
                $em->persist($anexo);
                $em->flush();
    
                $response->setData(['success' => true, 'msj' => "anexo registrada exitosamente,id : ".$anexo->getIdAnexo(), 'id'=>$anexo->getIdAnexo()]);
            }
           
            return $response;
        } catch (Exception $error) {
            $response->setData(['success' => false, 'msj' => "No se pudo registrar el anexo\nerror: {$error->getMessage()}"]);
            return $response;
        }
    }

}
