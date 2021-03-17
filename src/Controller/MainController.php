<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController{

        /**
         * @Route("/holloWord", name="hello")
         * 
         */
        
        public function holloWord(){

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