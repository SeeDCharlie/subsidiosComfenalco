<?php

namespace App\Controller;

use App\Entity\Subsidios;
use App\Repository\SubsidiosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SubsidiosController extends AbstractController
{

    /**
     * @Route("/subsidios",name="subsidios")
     */
    
    // public function consultarSubsidios(Request $request, SubsidiosRepository $subsidiosRepository): JsonResponse{

    //     $subsidios = $subsidiosRepository->findAll();
    //     $subsidiosArray = [];

    //     foreach ($subsidios as $subsidio) {                        
    //         $subsidiosArray [] = [
    //             'IdSubsidios' => $subsidio->getIdSubsidios(),
    //             'IdEstado' => $subsidio->getIdEstado(),
    //             'IdUsuario' = $subsidio->getId
    //         ]
    //     }

    // }


}
