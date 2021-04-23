<?php

namespace App\Controller;

use \Doctrine\ORM\EntityManager;
use App\Repository\ProgramasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Registry;


class AnexosController extends AbstractController
{

    /**
     *  @Route("/registrarFromulario",name="registrarFromulario", methods = {"POST"} )
     */

    public function registrarFormulario()
    {
        
    }
}
