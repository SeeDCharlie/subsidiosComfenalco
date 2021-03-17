<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController{

        /**
         * @Route("/holloWord", name="hello")
         * 
         */
        
        public function holloWord( Request $request, LoggerInterface $logger){

            $response = new JsonResponse();
            $response->setData([
                'succsees' => true,
                'data' => [
                    [
                        'dato' => 1,
                        'datoDos' => 'msjDos'
                    ],
                    
                ]
            ]);
            return $response;
        }
}