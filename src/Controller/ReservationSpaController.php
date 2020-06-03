<?php

namespace App\Controller;

use App\Entity\ReservationSpa;
use App\Form\ReservationSpaType;
use App\Repository\ReservationSpaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservation/spa")
 */
class ReservationSpaController extends AbstractController
{
    /**
     * @Route("/", name="reservation_spa_index", methods={"GET"})
     */
    public function index(ReservationSpaRepository $reservationSpaRepository): Response
    {
        return $this->render('reservation_spa/index.html.twig', [
            'reservation_spas' => $reservationSpaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="reservation_spa_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reservationSpa = new ReservationSpa();
        $form = $this->createForm(ReservationSpaType::class, $reservationSpa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservationSpa);
            $entityManager->flush();

            return $this->redirectToRoute('reservation_spa_index');
        }

        return $this->render('reservation_spa/new.html.twig', [
            'reservation_spa' => $reservationSpa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservation_spa_show", methods={"GET"})
     */
    public function show(ReservationSpa $reservationSpa): Response
    {
        return $this->render('reservation_spa/show.html.twig', [
            'reservation_spa' => $reservationSpa,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reservation_spa_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ReservationSpa $reservationSpa): Response
    {
        $form = $this->createForm(ReservationSpaType::class, $reservationSpa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservation_spa_index');
        }

        return $this->render('reservation_spa/edit.html.twig', [
            'reservation_spa' => $reservationSpa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservation_spa_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ReservationSpa $reservationSpa): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationSpa->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservationSpa);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_spa_index');
    }
}
