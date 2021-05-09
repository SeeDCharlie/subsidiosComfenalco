<?php

namespace App\Services;

use App\Entity\EstadosSubsidios;
use App\Entity\Programas;
use App\Entity\Subsidios;
use App\Entity\Usuarios;
use DateTime;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SubsidiosServices
{



    public function registrarSubsidio($dats, $em, $nameFileDirectory)
    {
        try {

            $soliSubsidio = new Subsidios();
            $usr = $em->getRepository(Usuarios::class)->find($dats['idUsr']);
            $programa = $em->getRepository(Usuarios::class)->find($dats['idPrograma']);

            if ($usr == null) {
                return new JsonResponse("el usuario no existe", Response::HTTP_BAD_GATEWAY);
            }
            if ($programa == null) {
                return new JsonResponse("el programa no existe", Response::HTTP_BAD_GATEWAY);
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

            return new JsonResponse("solicitud registrada exitosamente,id :" . $soliSubsidio->getIdSubsidios(), Response::HTTP_OK);
        } catch (Exception $error) {
            return new JsonResponse("No se pudo registrar la solicitud de subsidio\nerror: {$error->getMessage()}", Response::HTTP_BAD_GATEWAY);
        }
    }


    public function actualizarSubsidio($dats, $entityManager)
    {

        try {

            $sub = $entityManager->getRepository(Subsidios::class)->find($dats['idSubsidio']);
            $estado = $entityManager->getRepository(EstadosSubsidios::class)->find($dats['idEstado']);
            $usr = $entityManager->getRepository(Usuarios::class)->find($dats['idUsr']);
            $programa = $entityManager->getRepository(Programas::class)->find($dats['idPrograma']);

            if ($sub == null ){
                return new JsonResponse("El subsidio no existe o el id es incorrecto", Response::HTTP_BAD_GATEWAY);
            }
            if ($estado == null ){
                return new JsonResponse("El estado no existe o el id es incorrecto", Response::HTTP_BAD_GATEWAY);
            }
            if ($usr == null ){
                return new JsonResponse("El usuario no existe o el id es incorrecto", Response::HTTP_BAD_GATEWAY);
            }
            if ($programa == null ){
                return new JsonResponse("El programa no existe o el id es incorrecto", Response::HTTP_BAD_GATEWAY);
            }

            $sub->setIdEstado($dats['idEstado']);
            $sub->setIdUsuario($dats['idUsr']);
            $sub->setIdPrograma($dats['idPrograma']);
            $sub->setFechaModificacion(new DateTime(date("Y-m-d")));
            $sub->setFechaFinalizacion(new DateTime($dats['fechaFinalizacion']));


            $entityManager->persist($sub);
            $entityManager->flush();

            return new JsonResponse("Subsidio actualizado", Response::HTTP_OK);

        } catch (Exception $error) {
            return new JsonResponse("No se pudo actualizar la solicitud de subsidio\nerror: ".$error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
