<?php

namespace App\Services;

use App\Entity\Subsidios;
use DateTime;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class SubsidiosServices
{



    public function registrarSubsidio($dats, $em)
    {

        $response = new JsonResponse();
        $soliSubsidio = new Subsidios();

        try {
            $soliSubsidio->setIdEstado(1);
            $soliSubsidio->setIdUsuario($dats['idUsr']);
            $soliSubsidio->setIdPrograma($dats['idPrograma']);
            $soliSubsidio->setFechaCreacion(new DateTime(date("Y-m-d")));
            $soliSubsidio->setFechaModificacion(new DateTime(date("Y-m-d")));
            $soliSubsidio->setFechaFinalizacion(new DateTime($dats['fechaFinalizacion']));
            

            $em->persist($soliSubsidio);
            $em->flush();

            $soliSubsidio->setFormulario("uploads/formularioInscripcion/".$soliSubsidio->getIdSubsidios()."_".$dats['nombreArchivo']);

            $em->flush();

            $response->setData(['success' => true, 'msj' => "solicitud registrada exitosamente,id :".$soliSubsidio->getIdSubsidios(), 'idSubsidio'=>$soliSubsidio->getIdSubsidios()]);
            return $response;
        } catch (Exception $error) {
            $response->setData(['success' => false, 'msj' => "No se pudo registrar la solicitud de subsidio\nerror: {$error->getMessage()}"]);
            return $response;
        }
    }
}
