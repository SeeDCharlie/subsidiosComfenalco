<?php

namespace App\Controller;

use App\Entity\Requerimientos;
use \Doctrine\ORM\EntityManager;
use App\Repository\ProgramasRepository;
use App\Repository\RequerimientosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Exception;

class RequerimietosController extends AbstractController{

    /**
     *  @Route("/requisitosById",name="requisitosById", methods = {"GET"})
     */
    public function requisitosById(Request $request, RequerimientosRepository $rr): JsonResponse {

        try {

            $idRequerimiento = $request->query->get('idRequerimiento');

            $serializer = $this->get('serializer');

            $requerimiento = $rr->find($idRequerimiento);

            if (!$requerimiento) {
                return new JsonResponse("Id requerimiento incorrecto", Response::HTTP_CONFLICT);
            } else {
                $data = $serializer->serialize($requerimiento, 'json');

                return new JsonResponse(json_decode($data, true), Response::HTTP_OK);
            }
        } catch (Exception $error) {
            return new JsonResponse(['success' => false, 'msj' => "error: {$error->getMessage()}"], Response::HTTP_NOT_FOUND);
        }

    }

}