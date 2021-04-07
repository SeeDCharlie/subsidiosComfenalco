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
            //$soliSubsidio->setFormulario($dats['url']);

            $em->persist($soliSubsidio);
            $em->flush();

            $response->setData(['success' => true, 'msj' => "solicitud registrada exitosamente"]);
            return $response;
        } catch (Exception $error) {
            $response->setData(['success' => false, 'msj' => "No se pudo registrar la solicitud de subsidio\nerror: {$error->getMessage()}"]);
            return $response;
        }
    }
}
