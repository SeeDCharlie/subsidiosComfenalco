<?php

namespace App\Services;

use App\Entity\Subsidios;
use App\Entity\Usuarios;
use DateTime;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class SubsidiosServices
{



    public function registrarSubsidio($dats, $em, $nameFileDirectory)
    {

        $response = new JsonResponse();
        

        try {

            $soliSubsidio = new Subsidios();


            $usr = $em->getRepository(Usuarios::class)->find($dats['idUsr']);

            if ($usr == null){
                $response->setData(['success' => false, 'msj' => "el usuario no existe"]);
                return $response;
            }

            $soliSubsidio->setIdEstado(1);
            
            $soliSubsidio->setIdUsuario($dats['idUsr']);
            $soliSubsidio->setIdPrograma($dats['idPrograma']);
            $soliSubsidio->setFechaCreacion(new DateTime(date("Y-m-d")));
            $soliSubsidio->setFechaModificacion(new DateTime(date("Y-m-d")));
            $soliSubsidio->setFechaFinalizacion(new DateTime($dats['fechaFinalizacion']));

            $em->persist($soliSubsidio);
            $em->flush();

            /*$file = $request->files->get('uploaded_file');
            $fileName = $soliSubsidio->getIdSubsidios().'form_'.new DateTime(date("Y-m-d")). '.' . $file->guessExtension();
            $file->move($nameFileDirectory, $fileName);

            $soliSubsidio->setFormulario($nameFileDirectory."/"."file.py");

            $em->flush();*/

            $response->setData(['success' => true, 'msj' => "solicitud registrada exitosamente,id :".$soliSubsidio->getIdSubsidios(), 'idSubsidio'=>$soliSubsidio->getIdSubsidios() ]);
            $response->setStatusCode(200);
            return $response;

        } catch (Exception $error) {
            $response->setData(['success' => false, 'msj' => "No se pudo registrar la solicitud de subsidio\nerror: {$error->getMessage()}"]);
            return $response;
        }
    }
}
