<?php

namespace App\Services;

use App\Entity\Ciudades;
use App\Entity\Generos;
use App\Entity\Paises;
use App\Entity\Subsidios;
use App\Entity\TiposDocumento;
use App\Entity\TipoUsuario;
use App\Entity\EstadosSubsidios;
use App\Entity\Usuarios;
use DateTime;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\UsuariosRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Length;

class UserServices
{

    public function userRegistration($requestDats, $em)
    {
        $usuario = new Usuarios();

        try {

            $tipoUsuario = $em->getRepository(TipoUsuario::class)->find($requestDats['idTipoUsr']);
            $tipoDocumento = $em->getRepository(TiposDocumento::class)->find($requestDats['idTipoDoc']);
            $ciudad = $em->getRepository(Ciudades::class)->find($requestDats['idCiudad']);
            $pais = $em->getRepository(Paises::class)->find($requestDats['idPais']);
            $noDocumento = $em->getRepository(Usuarios::class)->findOneBy(["numeroDocumento" => $requestDats['numeroDocumento']]);
            $email = $em->getRepository(Usuarios::class)->findOneBy(["eMail" => $requestDats['email']]);
            $genero = $em->getRepository(Generos::class)->find($requestDats['idGnr']);

            if(empty($requestDats['numeroDocumento'])){
                return new JsonResponse("Numero de documento vacio", Response::HTTP_BAD_GATEWAY);
            }
            if(empty($requestDats['email']) || strlen($requestDats['email']) < 7){
                return new JsonResponse("Direccion de correo incorrecta", Response::HTTP_BAD_GATEWAY);
            }
            if (!$tipoUsuario) {
                return new JsonResponse("tipo de usuario incorrecto", Response::HTTP_BAD_GATEWAY);
            }
            if (!$tipoDocumento) {
                return new JsonResponse("tipo de documento incorrecto", Response::HTTP_BAD_GATEWAY);
            }
            if (!$ciudad) {
                return new JsonResponse("ciudad incorrecta", Response::HTTP_BAD_GATEWAY);
            }
            if (!$pais) {
                return new JsonResponse("pais incorrecto", Response::HTTP_BAD_GATEWAY);
            }
            if ($noDocumento) {
                return new JsonResponse("ya existe un usuario con este numero de documento", Response::HTTP_BAD_GATEWAY);
            }
            if ($email) {
                return new JsonResponse("ya existe un usuario con esta direccion de correo", Response::HTTP_BAD_GATEWAY);
            }
            if (!$genero) {
                return new JsonResponse("El genero es incorrecto", Response::HTTP_BAD_GATEWAY);
            }
            if(empty($requestDats['nombre'])){
                return new JsonResponse("Nombre vacio", Response::HTTP_BAD_GATEWAY);
            }
            if(empty($requestDats['apellido'])){
                return new JsonResponse("Apellido vacio", Response::HTTP_BAD_GATEWAY);
            }
            if(empty($requestDats['password'])){
                return new JsonResponse("Contraseña vacia", Response::HTTP_BAD_GATEWAY);
            }
            

            $usuario->setNombre($requestDats['nombre']);
            $usuario->setApellido($requestDats['apellido']);
            $usuario->setFechaNacimiento(new DateTime($requestDats['fechaNacimiento']));
            $usuario->setIdGenero($requestDats['idGnr']);
            $usuario->setNumeroDocumento($requestDats['numeroDocumento']);
            $usuario->setEMail($requestDats['email']);
            $usuario->setIdCiudad($requestDats['idCiudad']);
            $usuario->setIdPais($requestDats['idPais']);
            $usuario->setIdTipoDoc($requestDats['idTipoDoc']);
            $usuario->setContraseÑa(password_hash($requestDats['password'], PASSWORD_DEFAULT));
            $usuario->setIdTipoUsuario($requestDats['idTipoUsr']);
            $em->persist($usuario);
            $em->flush();

            return new JsonResponse("usuario guardado exitosamente", Response::HTTP_OK);
        } catch (Exception $error) {
            return  new JsonResponse("No se pudo guardar el usuario\nerror: {$error->getMessage()}", Response::HTTP_BAD_GATEWAY);
        }
    }

    public function userUpdate($requestDats, $em)
    {

        try {
            $usuario = $em->getRepository(Usuarios::class)->find($requestDats['idUsr']);
            $tipoUsuario = $em->getRepository(TipoUsuario::class)->find($requestDats['idTipoUsr']);
            $tipoDocumento = $em->getRepository(TiposDocumento::class)->find($requestDats['idTipoDoc']);
            $ciudad = $em->getRepository(Ciudades::class)->find($requestDats['idCiudad']);
            $pais = $em->getRepository(Paises::class)->find($requestDats['idPais']);
            $genero = $em->getRepository(Generos::class)->find($requestDats['idGnr']);
            $email = $em->getRepository(Usuarios::class)->findOneBy(["eMail" => $requestDats['email']]);

            

            if (!$usuario) {
                return new JsonResponse("id usuario incorrecto", Response::HTTP_BAD_GATEWAY);
            }
            if(empty($requestDats['email'])){
                return new JsonResponse("Direccion de correo vacia", Response::HTTP_BAD_GATEWAY);
            }
            if($email && $email->getIdUsuario() != $usuario->getIdUsuario() ){
                return new JsonResponse("Este email ya esta registrado a otro usuario", Response::HTTP_BAD_GATEWAY);
            }
            if (!$tipoUsuario) {
                return new JsonResponse("tipo de usuario incorrecto", Response::HTTP_BAD_GATEWAY);
            }
            if (!$tipoDocumento) {
                return new JsonResponse("tipo de documento incorrecto", Response::HTTP_BAD_GATEWAY);
            }
            if (!$ciudad) {
                return new JsonResponse("ciudad incorrecta", Response::HTTP_BAD_GATEWAY);
            }
            if (!$pais) {
                return new JsonResponse("pais incorrecto", Response::HTTP_BAD_GATEWAY);
            }
            if (!$genero) {
                return new JsonResponse("El genero es incorrecto", Response::HTTP_BAD_GATEWAY);
            }
            if(empty($requestDats['nombre'])){
                return new JsonResponse("Nombre vacio", Response::HTTP_BAD_GATEWAY);
            }
            if(empty($requestDats['apellido'])){
                return new JsonResponse("Apellido vacio", Response::HTTP_BAD_GATEWAY);
            }
            if(empty($requestDats['numeroDocumento'])){
                return new JsonResponse("Numero de documento vacio", Response::HTTP_BAD_GATEWAY);
            }
            if(empty($requestDats['password'])){
                return new JsonResponse("Contraseña vacia", Response::HTTP_BAD_GATEWAY);
            }

            $usuario->setNombre($requestDats['nombre']);
            $usuario->setApellido($requestDats['apellido']);
            $usuario->setFechaNacimiento(new DateTime($requestDats['fechaNacimiento']));
            $usuario->setIdGenero($requestDats['idGnr']);
            $usuario->setNumeroDocumento($requestDats['numeroDocumento']);
            $usuario->setEMail($requestDats['email']);
            $usuario->setIdCiudad($requestDats['idCiudad']);
            $usuario->setIdPais($requestDats['idPais']);
            $usuario->setIdTipoDoc($requestDats['idTipoDoc']);
            $usuario->setContraseÑa(password_hash($requestDats['password'], PASSWORD_DEFAULT));
            $usuario->setIdTipoUsuario($requestDats['idTipoUsr']);
            $em->persist($usuario);
            $em->flush();

            return new JsonResponse("usuario actualizado exitosamente", Response::HTTP_OK);
        } catch (Exception $error) {

            return new JsonResponse("No se pudo guardar el usuario\nerror: {$error->getMessage()}", Response::HTTP_BAD_GATEWAY);
        }
    }

    public function userDelete($idUsr, $em)
    {
        try {

            $usuario = $em->getRepository(Usuarios::class)->find($idUsr);

            if (!$usuario) {
                return new JsonResponse("Usuario incorrecto", Response::HTTP_BAD_GATEWAY);
            }

            $em->remove($usuario);
            $em->flush();

            return new JsonResponse("usuario eliminado exitosamente", Response::HTTP_OK);
        } catch (Exception $error) {

            return new JsonResponse("Error inesperado : " . $error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function getSubsidiosByuserEmail($correo, $em, $serializer)
    {


        try {
            $query = $em->getRepository(Subsidios::class)->createQueryBuilder('s')
                ->select('e.estado', 'e.infoEstado', 'p.programa', 's.idSubsidios')
                ->innerJoin('App\Entity\EstadosSubsidios', 'e','WITH', 's.idEstado = e.idEstado')
                ->innerJoin('App\Entity\Programas', 'p','WITH', 's.idPrograma = p.idPrograma')
                ->innerJoin('App\Entity\Usuarios', 'u','WITH', 's.idUsuario = u.idUsuario')
                ->where('u.eMail = :correo')
                ->setParameter('correo', $correo)
                ->getQuery();
            $resultQuery = $query->getResult();

            if (!$resultQuery) {
                return new JsonResponse("No hay resultados para este correo : $correo", Response::HTTP_OK);
            } else {
                $data = $serializer->serialize($resultQuery, 'json');
                return new JsonResponse(json_decode($data, true), Response::HTTP_OK);
            }
        } catch (Exception $error) {
            return new JsonResponse("Error inesperado : ".$error->getMessage(), Response::HTTP_BAD_REQUEST);    
        }
    }


    public function getSubsidiosByuserId($id, $em, $serializer)
    {


        try {
            $query = $em->getRepository(Subsidios::class)->createQueryBuilder('s')
                ->select('e.estado', 'e.infoEstado', 'p.programa', 's.idSubsidios')
                ->innerJoin('App\Entity\EstadosSubsidios', 'e','WITH', 's.idEstado = e.idEstado')
                ->innerJoin('App\Entity\Programas', 'p','WITH', 's.idPrograma = p.idPrograma')
                ->innerJoin('App\Entity\Usuarios', 'u','WITH', 's.idUsuario = u.idUsuario')
                ->where('u.idUsuario = :id')
                ->setParameter('id', $id)
                ->getQuery();
            $resultQuery = $query->getResult();

            if (!$resultQuery) {
                return new JsonResponse("No hay subsidios para este id de usuario : $id", Response::HTTP_OK);
            } else {
                $data = $serializer->serialize($resultQuery, 'json');
                return new JsonResponse(json_decode($data, true), Response::HTTP_OK);
            }
        } catch (Exception $error) {
            return new JsonResponse("Error inesperado : ".$error->getMessage(), Response::HTTP_BAD_REQUEST);    
        }
    }
}
