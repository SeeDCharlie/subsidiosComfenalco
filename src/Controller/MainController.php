<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController{







        
  

        /**
         * @Route("/helloWorld", name="hello")
         * 
         */
        
        public function helloWorld( Request $request, LoggerInterface $logger){

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