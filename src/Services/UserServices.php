<?php

namespace App\Services;

use App\Entity\Ciudades;
use App\Entity\Generos;
use App\Entity\Paises;
use App\Entity\TiposDocumento;
use App\Entity\TipoUsuario;
use App\Entity\Usuarios;
use DateTime;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\UsuariosRepository;
use Symfony\Component\HttpFoundation\Response;

class UserServices
{

    public function userRegistration($requestDats , $em)
    {
        $response = new JsonResponse();
        $usuario = new Usuarios();

        try {

            $tipoUsuario= $em->getRepository(TipoUsuario::class)->find($requestDats['idTipoUsr']);
            $tipoDocumento= $em->getRepository(TiposDocumento::class)->find($requestDats['idTipoDoc']);
            $ciudad= $em->getRepository(Ciudades::class)->find($requestDats['idCiudad']);
            $pais= $em->getRepository(Paises::class)->find($requestDats['idPais']);
            $noDocumento = $em->getRepository(Usuarios::class)->findOneBy(["numeroDocumento"=>$requestDats['numeroDocumento']]);
            $email = $em->getRepository(Usuarios::class)->findOneBy(["eMail"=>$requestDats['email']]) ;
            $genero = $em->getRepository(Generos::class)->find($requestDats['idGnr']);

            if(!$tipoUsuario ){
                return new JsonResponse(["msj"=>"tipo de usuario incorrecto"], Response::HTTP_BAD_GATEWAY);
            }
            if(!$tipoDocumento){
                return new JsonResponse(["msj"=>"tipo de documento incorrecto"], Response::HTTP_BAD_GATEWAY);
            }
            if(!$ciudad){
                return new JsonResponse(["msj"=>"ciudad incorrecta"], Response::HTTP_BAD_GATEWAY);
            }
            if(!$pais){
                return new JsonResponse(["msj"=>"pais incorrecto"], Response::HTTP_BAD_GATEWAY);
            }
            if($noDocumento){
                return new JsonResponse(["msj"=>"ya existe un usuario con este numero de documento"], Response::HTTP_BAD_GATEWAY);
            }
            if($email){
                return new JsonResponse(["msj"=>"ya existe un usuario con esta direccion de correo"], Response::HTTP_BAD_GATEWAY);
            }
            if(!$genero){
                return new JsonResponse(["msj"=>"El genero es incorrecto"], Response::HTTP_BAD_GATEWAY);
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

            return new JsonResponse(['success' => true, "msj"=>"usuario guardado exitosamente"], Response::HTTP_OK);
            
        } catch (Exception $error) {
            $response->setData(['success' => false, 'msj' => "No se pudo guardar el usuario\nerror: {$error->getMessage()}"]);
            return $response;
        }
    }

    public function userUpdate($requestDats , $em){

        try {
            $usuario = $em->getRepository(Usuarios::class)->find($requestDats['idUsr']);
            $tipoUsuario= $em->getRepository(TipoUsuario::class)->find($requestDats['idTipoUsr']);
            $tipoDocumento= $em->getRepository(TiposDocumento::class)->find($requestDats['idTipoDoc']);
            $ciudad= $em->getRepository(Ciudades::class)->find($requestDats['idCiudad']);
            $pais= $em->getRepository(Paises::class)->find($requestDats['idPais']);
            $genero = $em->getRepository(Generos::class)->find($requestDats['idGnr']);

            if(!$usuario){
                return new JsonResponse(["msj"=>"usuario incorrecto"], Response::HTTP_BAD_GATEWAY);
            }
            if(!$tipoUsuario ){
                return new JsonResponse(["msj"=>"tipo de usuario incorrecto"], Response::HTTP_BAD_GATEWAY);
            }
            if(!$tipoDocumento){
                return new JsonResponse(["msj"=>"tipo de documento incorrecto"], Response::HTTP_BAD_GATEWAY);
            }
            if(!$ciudad){
                return new JsonResponse(["msj"=>"ciudad incorrecta"], Response::HTTP_BAD_GATEWAY);
            }
            if(!$pais){
                return new JsonResponse(["msj"=>"pais incorrecto"], Response::HTTP_BAD_GATEWAY);
            }
            if(!$genero){
                return new JsonResponse(["msj"=>"El genero es incorrecto"], Response::HTTP_BAD_GATEWAY);
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

            return new JsonResponse(['success' => true, "msj"=>"usuario actualizado exitosamente" ], Response::HTTP_OK);
            
        } catch (Exception $error) {
            
            return new JsonResponse(['success' => false, 'msj' => "No se pudo guardar el usuario\nerror: {$error->getMessage()}"], Response::HTTP_BAD_GATEWAY);
        }

    }

    public function userDelete($idUsr , $em){
        try {
            
            $usuario = $em->getRepository(Usuarios::class)->find($idUsr);

            if(!$usuario){
                return new JsonResponse("Usuario incorrecto", Response::HTTP_BAD_GATEWAY);
            }

            $em->remove($usuario);
            $em->flush();

            return new JsonResponse(['success' => true, "msj"=>"usuario eliminado exitosamente" ], Response::HTTP_OK);
            
        } catch (Exception $error) {

            return new JsonResponse("Error inesperado : ".$error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function getUserById(){

    }
    
}
