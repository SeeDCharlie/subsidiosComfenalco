<?php

namespace App\Controller;

use App\Entity\Subsidios;
use App\Form\SubsidiosType;
use App\Repository\SubsidiosRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/subsidios")
 */
class SubsidiosController extends AbstractController
{
    /**
     * @Route("/", name="subsidios_index", methods={"GET"})
     */
    public function index(SubsidiosRepository $subsidiosRepository): Response
    {
        return $this->render('subsidios/index.html.twig', [
            'subsidios' => $subsidiosRepository->findAll(),
        ]);
    }

    /**
    *   funcion para registrar una nueva peticion a algun programa de subsidios 
    */
    /**s
     * @Route("/regisSubsidio", name="regisSubsidio", methods={"POST"})
     */
    
     
     
    public function regisSubsidio(Request $request, EntityManagerInterface $em) {
        $response = new JsonResponse();
        $soliSubsidio = new Subsidios();
        if ($request->getMethod() == 'POST') {
            try {
                
                //$estadoSub = $em->find('EstadosSubsidios','1');
                $requestDats = json_decode($request->getContent(), true);

                $soliSubsidio->setIdEstado(1);
                $soliSubsidio->setIdUsuario($requestDats['idUsr'] );
                $soliSubsidio->setIdPrograma($requestDats['idPrograma']);
                $soliSubsidio->setFechaCreacion( new DateTime(date("Y-m-d")) );
                $soliSubsidio->setFechaModificacion( new DateTime(date("Y-m-d"))  );
                $soliSubsidio->setFechaFinalizacion($requestDats['fechaFinalizacion']);
                $soliSubsidio->setFormulario($requestDats['url']);
    
                $em->persist($soliSubsidio);
                $em->flush();
                
                $response->setData(['success' => true, 'msj' => "solicitud registrada exitosamente"]);
                return $response;
            } catch (Exception $error) {
                $response->setData(['success' => false, 'msj' => "No se pudo crear la sulicitud\nerror: {$error->getMessage()}"]);
                return $response;
            }
        } else {
            $response->setData(['success' => false, 'msj' => "Method GET don't response"]);
            return $response;
        }
    }

    /**
     * @Route("/{idSubsidios}", name="subsidios_show", methods={"GET"})
     */
    public function show(Subsidios $subsidio): Response
    {
        return $this->render('subsidios/show.html.twig', [
            'subsidio' => $subsidio,
        ]);
    }

    /**
     * @Route("/{idSubsidios}/edit", name="subsidios_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Subsidios $subsidio): Response
    {
        $form = $this->createForm(SubsidiosType::class, $subsidio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subsidios_index');
        }

        return $this->render('subsidios/edit.html.twig', [
            'subsidio' => $subsidio,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idSubsidios}", name="subsidios_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Subsidios $subsidio): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subsidio->getIdSubsidios(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subsidio);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subsidios_index');
    }
}
