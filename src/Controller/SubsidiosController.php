<?php

namespace App\Controller;

use App\Entity\Subsidios;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\SubsidiosServices;


class SubsidiosController extends AbstractController
{

    /**
     * @Route("/registrarSubsidio", name="registrarSubsidio")
     */


    public function regisSubsidio(Request $request, EntityManagerInterface $em, SubsidiosServices $ss)
    {
        $response = new JsonResponse();
        if ($request->getMethod() == 'POST') {

            $requestDats = json_decode($request->getContent(), true);
            return $ss->registrarSubsidio($requestDats, $em);
        } else {
            $response->setData(['success' => false, 'msj' => "Method GET don't response"]);
            return $response;
        }
    }


    


}
