<?php

namespace App\Controller;

use App\Repository\UsuariosRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\UserServices;
use Doctrine\ORM\EntityManager;
use Exception;


class UserController extends AbstractController
{

    /**
     * @Route("/getAllDataUserByCorreo", name="getAllDataUserByCorreo", methods = {"GET"})
     * 
     */

    public function getAllDataUserByCorreo(Request $request, UsuariosRepository $usuariosRepository): JsonResponse
    {
        try {
            $response = new JsonResponse();

            $correo = $request->query->get('correo');

            $serializer = $this->get('serializer');

            $usr = $usuariosRepository->findOneBy(['eMail' => $correo]);

            if (!$usr) {
                return new JsonResponse("No Existen Usuarios con este correo : $correo", Response::HTTP_CONFLICT);
            } else {
                $data = $serializer->serialize($usr, 'json');

                $response->setData(json_decode($data, true), Response::HTTP_OK);
                return $response;
            }
        } catch (Exception $error) {
            $response->setData("error: {$error->getMessage()}", Response::HTTP_NOT_FOUND);
            return $response;
        }
    }

    /**
     * @Route("/getAllEmails", name="getAllEmails", methods = {"GET"})
     * 
     */

    public function getAllUserEmails(Request $request, UsuariosRepository $usuariosRepository): JsonResponse
    {
        $userEmails = $usuariosRepository->getAllEmails();
        return new JsonResponse($userEmails, Response::HTTP_OK);
    }

    /**
     * @Route("/getUserSubsidios", name="getUserSubsidios", methods = {"GET"})
     * 
     */

    public function getUserSubsidiosApli(Request $request, UserServices $us, EntityManagerInterface $em): JsonResponse
    {
        try {

            $serializer = $this->get('serializer');
            $correo = $request->query->get('correo');
            return $us->getSubsidiosByuserEmail($correo, $em, $serializer);
        } catch (Exception $error) {
            return new JsonResponse("error : " . $error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/getSubsidiosByuserId", name="getSubsidiosByuserId", methods = {"GET"})
     * 
     */

    public function getSubsidiosByuserId(Request $request, UserServices $us, EntityManagerInterface $em): JsonResponse
    {
        try {
            $serializer = $this->get('serializer');
            $id = $request->query->get('id');
            return $us->getSubsidiosByuserId($id, $em, $serializer);
        } catch (Exception $error) {
            return new JsonResponse("error : " . $error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/UserRegistration", name="UserRegistration",methods = {"POST"})
     * 
     */

    public function UserRegistration(Request $request, EntityManagerInterface $em, UserServices $us)
    {
        try {
            return $us->userRegistration(json_decode($request->getContent(), true), $em);
        } catch (Exception $error) {
            return new JsonResponse("error : " . $error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/actualizarUsuario", name="actualizarUsuario", methods = {"PUT"} )
     */

    public function actualizarUsuario(Request $request, EntityManagerInterface $em, UserServices $us)
    {
        try {
            return $us->userUpdate(json_decode($request->getContent(), true), $em);
        } catch (Exception $error) {
            return new JsonResponse("Error inesperado : " . $error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/eliminarUsuario", name="eliminarUsuario",methods = {"DELETE"})
     * 
     */

    public function eliminarUsuario(Request $request, EntityManagerInterface $em, UserServices $us)
    {
        try {
            $idUsr = $request->query->get('idUsuario');
            return $us->userDelete($idUsr, $em);
        } catch (Exception $error) {
            return new JsonResponse("Error inesperado : " . $error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * @Route("/getAllUsers", name="getAllUsers", methods = { "GET"})
     * 
     */

    public function getAllUser(UsuariosRepository $ur)
    {
        try {
            $serializer = $this->get('serializer');
            $data = $serializer->serialize($ur->findAll(), 'json');

            return new JsonResponse(json_decode($data, true), Response::HTTP_OK);
        } catch (Exception $error) {
            return new JsonResponse("error: {$error->getMessage()}", Response::HTTP_BAD_GATEWAY);
        }
    }
    /**
     * @Route("/getUserByid", name="getUserByid", methods = {"GET"})
     * 
     */

    public function getUserByid(Request $request, UsuariosRepository $ur)
    {
        try {
            $idUsr = $request->query->get('idUsuario');

            $usuario = $ur->find($idUsr);

            if (!$usuario) {
                return new JsonResponse("Usuario incorrecto", Response::HTTP_BAD_GATEWAY);
            }

            $serializer = $this->get('serializer');
            $data = $serializer->serialize($usuario, 'json');

            return new JsonResponse(json_decode($data, true), Response::HTTP_OK);
        } catch (Exception $error) {
            return new JsonResponse("error: {$error->getMessage()}", Response::HTTP_BAD_GATEWAY);
        }
    }

    /**
     * @Route("/cambiarTokenCel", name="cambiarTokenCel", methods = {"PUT"})
     * 
     */

    public function cambiarTokenCel(Request $request, UsuariosRepository $ur, EntityManagerInterface $em )
    {
        try {
            $dats = json_decode($request->getContent(), true);

            $usuario = $ur->findOneByEMail($dats['email']);
            $token = $dats['tokenCel'];

            if (!$usuario) {
                return new JsonResponse("el email no existe", Response::HTTP_BAD_GATEWAY);
            }

            $usuario->setTokenCel($token);
            $em->persist($usuario);
            $em->flush();

            return new JsonResponse('token actualizado', Response::HTTP_OK);
        } catch (Exception $error) {
            return new JsonResponse("error: {$error->getMessage()}", Response::HTTP_BAD_GATEWAY);
        }
    }
}
