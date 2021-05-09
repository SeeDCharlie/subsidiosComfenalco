<?php

namespace App\Services;

use App\Entity\Anexos;
use App\Entity\ProgramaRequerimientos;
use App\Entity\Subsidios;
use App\Repository\SubsidiosRepository;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AnexosService
{


    public function registrarAnexo($dats, $em)
    {

        $response = new JsonResponse();
        $anexo = new Anexos();

        try {

            $subsidio = $em->getRepository(Subsidios::class)->find($dats['idSubsidio']);
            $requerimiento = $em->getRepository(ProgramaRequerimientos::class)->find($dats['idProgRequerimiento']);
            if ($subsidio == null) {
                $response->setData(['success' => false, 'msj' => "El subsidio no existe"], Response::HTTP_BAD_GATEWAY);
            }
            if ($requerimiento == null) {
                $response->setData(['success' => false, 'msj' => "El requerimiento no existe"], Response::HTTP_BAD_GATEWAY);
            }
            if ($subsidio != null && $requerimiento != null) {

                $anexo->setEstado($dats['estado']);
                $anexo->setObservaciones($dats['observaciones']);

                $anexo->setIdSubsidios($dats['idSubsidio']);
                $anexo->setIdProgReq($dats['idProgRequerimiento']);
                $anexo->setDocumento("uploads/evidenciasSubsidio/" . $dats['idSubsidio'] . "/" . $dats['idProgRequerimiento'] . "_" . $dats['nombreArchivo']);

                $em->persist($anexo);
                $em->flush();

                $response->setData(['success' => true, 'msj' => "anexo registrada exitosamente,id : " . $anexo->getIdAnexo(), 'id' => $anexo->getIdAnexo()], Response::HTTP_OK);
            }

            return $response;
        } catch (Exception $error) {
            $response->setData(['success' => false, 'msj' => "No se pudo registrar el anexo\nerror: {$error->getMessage()}"], Response::HTTP_BAD_GATEWAY);
            return $response;
        }
    }


    public function actualizarAnexo($dats, $em)
    {

        try {
            $anexo = $em->getRepository(Anexos::class)->find($dats['idAnexo']);
            $subsidio = $em->getRepository(Subsidios::class)->find($dats['idSubsidio']);
            $requerimiento = $em->getRepository(ProgramaRequerimientos::class)->find($dats['idProgRequerimiento']);

            if (!$anexo) {
                return new JsonResponse(['success' => false, 'msj' => "El anexo no existe"], Response::HTTP_BAD_GATEWAY);
            }
            if (!$subsidio) {
                return new JsonResponse(['success' => false, 'msj' => "El subsidio no existe"], Response::HTTP_BAD_GATEWAY);
            }
            if (!$requerimiento) {
                return new JsonResponse(['success' => false, 'msj' => "El requerimiento no existe"], Response::HTTP_BAD_GATEWAY);
            }

            $anexo->setEstado($dats['estado']);
            $anexo->setObservaciones($dats['observaciones']);
            $anexo->setIdSubsidios($dats['idSubsidio']);
            $anexo->setIdProgReq($dats['idProgRequerimiento']);
            $anexo->setDocumento("uploads/evidenciasSubsidio/" . $dats['idSubsidio'] . "/" . $dats['idProgRequerimiento'] . "_" . $dats['nombreArchivo']);

            $em->persist($anexo);
            $em->flush();

            return new JsonResponse(['success' => true, 'msj' => "anexo actualizado exitosamente,id : " . $anexo->getIdAnexo(), 'id' => $anexo->getIdAnexo()], Response::HTTP_OK);
        } catch (Exception $error) {
            return new JsonResponse(['success' => false, 'msj' => "No se pudo actualizar el anexo\nerror: {$error->getMessage()}"], Response::HTTP_BAD_GATEWAY);
        }
    }



    public function getAnexosPorIdSubsidio($idSubsidio, $em, $serializer){
        try {

            $subsidio = $em->getRepository(Subsidios::class)->find($idSubsidio);
            
            if(!$subsidio){
                return new JsonResponse(['success' => false, 'msj' => "El subsidio es incorrecto"]);
            }else{
                $anexos = $em->getRepository(Anexos::class)->findByIdSubsidios($idSubsidio);
                if(!$anexos){
                    return new JsonResponse(['success' => false, 'msj' => "No hay anexos registrados a este subsidio"], Response::HTTP_BAD_GATEWAY);
                }else{
                    $data = $serializer->serialize($anexos, 'json');

                    return new JsonResponse(json_decode($data, true), Response::HTTP_OK);
                }
            }
        } catch (Exception $error) {
            return new JsonResponse(['success' => false, 'msj' => "No se pudo devolver la lista de anexos\nerror: {$error->getMessage()}"], Response::HTTP_BAD_GATEWAY);
        }
    }
}
