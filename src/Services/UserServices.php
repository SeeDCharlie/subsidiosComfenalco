<?php

namespace App\Services;

use App\Entity\Usuarios;
use DateTime;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\UsuariosRepository;


class UserServices
{

    public function userRegistration($requestDats , $em)
    {
        $response = new JsonResponse();
        $usuario = new Usuarios();

        try {

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

            $response->setData(['success' => true, 'msj' => "usuario guardado exitosamente"]);
            return $response;
            
        } catch (Exception $error) {
            $response->setData(['success' => false, 'msj' => "No se pudo guardar el usuario\nerror: {$error->getMessage()}"]);
            return $response;
        }
    }


    public function userUpdate(){

    }

    public function userDelete(){

    }

    public function getAllUser(UsuariosRepository $ur){
        $response = new JsonResponse();

        try {


            $response->setData(['success' => true, 'usuarios' => ""]);
            return $response;
            
        } catch (Exception $error) {
            $response->setData(['success' => false, 'msj' => "error: {$error->getMessage()}"]);
            return $response;
        }
    }

    public function getUserById(){

    }
    
}
