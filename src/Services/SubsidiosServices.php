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

    public function registrarSubsidio($request, $em, $nameFileDirectory)
    {
        try {

            $datos = json_decode($request->getContent(), true);

            $idUsuario = $datos['idUsr'];
            $idPrograma = $datos['idPrograma'];
            $fechaFin = $datos['fechaFinalizacion'];
            $url = $datos['formulario'];
            $soliSubsidio = new Subsidios();
            $usr = $em->getRepository(Usuarios::class)->find($idUsuario);
            $programa = $em->getRepository(Programas::class)->find($idPrograma);
            //$file = $request->files->get('uploaded_file');          

            if (!$usr) {
                return new JsonResponse("el usuario no existe", Response::HTTP_BAD_GATEWAY);
            }
            if (!$programa) {
                return new JsonResponse("el programa no existe", Response::HTTP_BAD_GATEWAY);
            }
            /*if(!$file){
                return new JsonResponse("el archivo formulario no existe", Response::HTTP_BAD_GATEWAY);
            }*/
            $query = $em->getRepository(Subsidios::class)->createQueryBuilder('s')
                                ->where('s.idUsuario = :usr and s.idPrograma = :programa and s.idEstado < 5')
                                ->select('s')
                                ->setParameter('usr',$idUsuario)
                                ->setParameter('programa', $idPrograma);

            if($query->getQuery()->getOneOrNullResult()){
                return new JsonResponse("el usuario ya empezo un proceso para este programa", Response::HTTP_BAD_GATEWAY);
            }

            $soliSubsidio->setIdEstado(1);
            $soliSubsidio->setIdUsuario($idUsuario);
            $soliSubsidio->setIdPrograma($idPrograma);
            $soliSubsidio->setFechaCreacion(new DateTime(date("Y-m-d")));
            $soliSubsidio->setFechaModificacion(new DateTime(date("Y-m-d")));
            $soliSubsidio->setFechaFinalizacion(new DateTime($fechaFin));
            $soliSubsidio->setFormulario($url);

            $em->persist($soliSubsidio);
            $em->flush();

            /*$fileName = $soliSubsidio->getIdSubsidios().'_form_'.uniqid(). '.' . $file->guessExtension();
            $file->move($nameFileDirectory, $fileName);*/
            //$soliSubsidio->setFormulario("uploads/formularioInscripcion/".$fileName);
            //$em->flush();

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

    public function actualizarSubsidioDos($dats, $entityManager)
    {

        try {
            
            $sub = $entityManager->getRepository(Subsidios::class)->find($dats['idSubsidios']);
            $estado = $entityManager->getRepository(EstadosSubsidios::class)->find($dats['idEstado']);
            $usr = $entityManager->getRepository(Usuarios::class)->find($dats['idUsuario']);
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
            $sub->setIdUsuario($dats['idUsuario']);
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




    public function getContSusidiosStat($em){

        try{
            $postulado = $em->getRepository(Subsidios::class)->count(['idEstado' => 1]);
            $porVerificar = $em->getRepository(Subsidios::class)->count(['idEstado' => 2]);
            $calificado = $em->getRepository(Subsidios::class)->count(['idEstado' => 3]);
            $asignado = $em->getRepository(Subsidios::class)->count(['idEstado' => 4]);
            $cancelado = $em->getRepository(Subsidios::class)->count(['idEstado' => 5]);

            return new JsonResponse(['postulado'=> $postulado, 'porVerificar' => $porVerificar, 'calificado' => $calificado, 'asignado' => $asignado , 'cancelado' => $cancelado], Response::HTTP_OK);

        }
        catch(Exception $error){
            return new JsonResponse("error inesperado \nerror: ".$error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
