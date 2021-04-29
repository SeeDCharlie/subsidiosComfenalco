<?php

namespace App\Controller;

use App\Entity\Subsidios;
use App\Services\SubsidiosServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class SubsidiosController extends AbstractController
{

    /**
     * @Route("/registrarSubsidio", name="registrarSubsidio")
     */


    public function regisSubsidio(Request $request, EntityManagerInterface $em, SubsidiosServices $ss, ParameterBagInterface $params)
    {
        $response = new JsonResponse();
        if ($request->getMethod() == 'POST') {


            return $ss->registrarSubsidio($request, $em, $params->get('forms_directory'));
        } else {
            $response->setData(['success' => false, 'msj' => "Method GET don't response"]);
            return $response;
        }
    }


    


}
