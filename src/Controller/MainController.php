<?php

namespace App\Controller;

use App\Entity\Usuarios;
use App\Repository\GenerosRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



class MainController extends AbstractController
{


    /**
     * @Route("/UserRegistration", name="UserRegistration")
     * 
     */

    public function UserRegistration(Request $request, EntityManagerInterface $em, GenerosRepository $genRep)
    {
        $response = new JsonResponse();
        $usuario = new Usuarios();
        if ($request->getMethod() == 'POST') {
            try {

                $requestDats = json_decode($request->getContent(), true);
                
                $usuario->setNombre($requestDats['nombre'] );
                $usuario->setApellido( $requestDats['apellido']);
                $usuario->setFechaNacimiento( new DateTime($requestDats['fechaNacimiento']));
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
        } else {
            $response->setData(['success' => false, 'msj' => "Method GET don't response"]);
            return $response;
        }
    }


    /**
     * @Route("/helloWorld", name="hello")
     * 
     */

    public function helloWorld(Request $request, LoggerInterface $logger)
    {

        $response = new JsonResponse();
        $response->setData([
            'succsees' => true,
            'data' => [
                [
                    'id_api' => 1,
                    'response' => 'Api subsidios comfenalco'
                ],

            ]
        ]);
        return $response;
    }
}
