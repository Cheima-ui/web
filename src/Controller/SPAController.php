<?php

namespace App\Controller;

use App\Entity\Spa;
use App\Form\SpaType;
use App\Repository\SpaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/spa")
 */
class SpaController extends AbstractController
{
    /**
     * @Route("/", name="spa_index", methods={"GET"})
     */
    public function index(SpaRepository $SpaRepository): Response
    {
        return $this->render('spa/index.html.twig', [
            'Spa' => $SpaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="spa_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $spa = new Spa();
        $form = $this->createForm(SpaType::class, $spa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($spa);
            $entityManager->flush();

            return $this->redirectToRoute('spa_index');
        }

        return $this->render('spa/new.html.twig', [
            'spa' => $spa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="spa_show", methods={"GET"})
     */
    public function show(Spa $spa): Response
    {
        return $this->render('spa/show.html.twig', [
            'spa' => $spa,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="spa_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Spa $spa): Response
    {
        $form = $this->createForm(SpaType::class, $spa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('spa_index');
        }

        return $this->render('spa/edit.html.twig', [
            'spa' => $spa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="spa_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Spa $spa): Response
    {
        if ($this->isCsrfTokenValid('delete'.$spa->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($spa);
            $entityManager->flush();
        }

        return $this->redirectToRoute('spa_index');
    }
}
