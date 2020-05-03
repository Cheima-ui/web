<?php

namespace App\Controller;

use App\Entity\SPA;
use App\Form\SPAType;
use App\Repository\SPARepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/s/p/a")
 */
class SPAController extends AbstractController
{
    /**
     * @Route("/", name="s_p_a_index", methods={"GET"})
     */
    public function index(SPARepository $sPARepository): Response
    {
        return $this->render('spa/index.html.twig', [
            's_p_as' => $sPARepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="s_p_a_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sPA = new SPA();
        $form = $this->createForm(SPAType::class, $sPA);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sPA);
            $entityManager->flush();

            return $this->redirectToRoute('s_p_a_index');
        }

        return $this->render('spa/new.html.twig', [
            's_p_a' => $sPA,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="s_p_a_show", methods={"GET"})
     */
    public function show(SPA $sPA): Response
    {
        return $this->render('spa/show.html.twig', [
            's_p_a' => $sPA,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="s_p_a_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SPA $sPA): Response
    {
        $form = $this->createForm(SPAType::class, $sPA);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('s_p_a_index');
        }

        return $this->render('spa/edit.html.twig', [
            's_p_a' => $sPA,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="s_p_a_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SPA $sPA): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sPA->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sPA);
            $entityManager->flush();
        }

        return $this->redirectToRoute('s_p_a_index');
    }
}
