<?php

namespace App\Controller;

use App\Entity\Subsidios;
use App\Form\SubsidiosType;
use App\Repository\SubsidiosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/new", name="subsidios_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $subsidio = new Subsidios();
        $form = $this->createForm(SubsidiosType::class, $subsidio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subsidio);
            $entityManager->flush();

            return $this->redirectToRoute('subsidios_index');
        }

        return $this->render('subsidios/new.html.twig', [
            'subsidio' => $subsidio,
            'form' => $form->createView(),
        ]);
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
