<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Chambres;
use App\Form\ChambresType;
use App\Repository\SpaRepository;
use App\Entity\Spa;
use App\Form\SpaType;
use App\Repository\ChambresRepository;

class AcceuilController extends AbstractController
{
    /**
     * @Route("/acceuil", name="acceuil")
     */
    public function index()
    {
        return $this->render('acceuil/index.html.twig', [
            'controller_name' => 'AcceuilController',
        ]);
    }


    /**
     * @Route("/show_res", name="lister")
     */
    public function reservation()
    {
        return $this->render('acceuil/reservation.html.twig', [
            'controller_name' => 'AcceuilController',
        ]);
    }




        /**
         * @Route("/res_chambre", name="Reservation_chambres")
         */
        public function reservationChambres(ChambresRepository $chambresRepository)
        {
            return $this->render('acceuil/reservationChambre.html.twig', [
                'chambres' => $chambresRepository->findAll(),
            ]);

        }



        /**
         * @Route("/res_SPA", name="Reservation_SPA")
         */
        public function reservationSPA(SpaRepository $SpaRepository)
        {
            return $this->render('acceuil/reservationSPA.html.twig', [
                'Spas' => $SpaRepository->findAll(),
            ]);

        }





}
