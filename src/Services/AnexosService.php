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


    public function registrarAnexo($request, $em, $fileDir)
    {

        $anexo = new Anexos();

        try {

            $datos = json_decode($request->getContent(), true);

            $idSubsidio = $datos['idSubsidio'];
            $idProgRequerimiento = $datos['idProgRequerimiento'];
            $estado = $datos['estado'];
            $observaciones = $datos['observaciones'];
            $document = $datos['documento'];

            $subsidio = $em->getRepository(Subsidios::class)->find($idSubsidio);
            $requerimiento = $em->getRepository(ProgramaRequerimientos::class)->find($idProgRequerimiento);
            
            //$file = $request->files->get('uploaded_file'); 
            
            /*if(!$file){
                return new JsonResponse("No hay un archivo cargado", Response::HTTP_BAD_GATEWAY);
            }*/
            if (!$subsidio) {
                return new JsonResponse("El subsidio es incorrecto", Response::HTTP_BAD_GATEWAY);
            }
            if (!$requerimiento) {
                return new JsonResponse("El requerimiento es incorrecto", Response::HTTP_BAD_GATEWAY);
            }

            $anexo->setEstado($estado);
            $anexo->setObservaciones($observaciones);
            $anexo->setIdSubsidios($idSubsidio);
            $anexo->setIdProgReq($idProgRequerimiento);
            $anexo->setDocumento($document);
            
            $em->persist($anexo);
            $em->flush();

            /*$fileName = $anexo->getIdAnexo().'_anexo_'.uniqid(). '.' . $file->guessExtension();
            $file->move($fileDir, $fileName);
            $em->flush();*/

            return new JsonResponse("anexo registrada exitosamente,id : " . $anexo->getIdAnexo(), Response::HTTP_OK);
        } catch (Exception $error) {
            return new JsonResponse("No se pudo registrar el anexo\nerror: {$error->getMessage()}", Response::HTTP_BAD_GATEWAY);
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
            if(empty($dats['documento'])){
                return new JsonResponse(['success' => false, 'msj' => "NO hay Url para el documento"], Response::HTTP_BAD_GATEWAY);
            }

            $anexo->setEstado($dats['estado']);
            $anexo->setObservaciones($dats['observaciones']);
            $anexo->setIdSubsidios($dats['idSubsidio']);
            $anexo->setIdProgReq($dats['idProgRequerimiento']);
            $anexo->setDocumento($dats['documento']);

            $em->persist($anexo);
            $em->flush();

            return new JsonResponse(['success' => true, 'msj' => "anexo actualizado exitosamente,id : " . $anexo->getIdAnexo(), 'id' => $anexo->getIdAnexo()], Response::HTTP_OK);
        } catch (Exception $error) {
            return new JsonResponse(['success' => false, 'msj' => "No se pudo actualizar el anexo\nerror: {$error->getMessage()}"], Response::HTTP_BAD_GATEWAY);
        }
    }



    public function getAnexosPorIdSubsidio($idSubsidio, $em, $serializer)
    {
        try {

            $subsidio = $em->getRepository(Subsidios::class)->find($idSubsidio);

            if (!$subsidio) {
                return new JsonResponse(['success' => false, 'msj' => "El subsidio es incorrecto"]);
            } else {

                $query = $em->getRepository(Anexos::class)->createQueryBuilder('a')
                ->select('a.idAnexo','a.idSubsidios', 'pr.idPrograma', 'a.estado', 'a.observaciones', 'a.documento', 'p.programa', 'r.requerimiento')
                ->innerJoin('App\Entity\ProgramaRequerimientos', 'pr','WITH', 'a.idProgReq = pr.idProgReq')
                ->innerJoin('App\Entity\Programas', 'p','WITH', 'pr.idPrograma = p.idPrograma')
                ->innerJoin('App\Entity\Requerimientos', 'r','WITH', 'r.idRequerimientos = pr.idRequerimientos')
                ->where('a.idSubsidios = :id')
                ->setParameter('id', $idSubsidio)
                ->getQuery();
                $anexos = $query->getResult();
                
                //$anexos = $em->getRepository(Anexos::class)->findByIdSubsidios($idSubsidio);
                 
                if (!$anexos) {
                    return new JsonResponse(['success' => false, 'msj' => "No hay anexos registrados a este subsidio"], Response::HTTP_BAD_GATEWAY);
                } else {
                    $data = $serializer->serialize($anexos, 'json');

                    return new JsonResponse(json_decode($data, true), Response::HTTP_OK);
                }
            }
        } catch (Exception $error) {
            return new JsonResponse(['success' => false, 'msj' => "No se pudo devolver la lista de anexos\nerror: {$error->getMessage()}"], Response::HTTP_BAD_GATEWAY);
        }
    }


    public function anexosAprobadosPorSubsidio(){
        echo "";
    }
}
