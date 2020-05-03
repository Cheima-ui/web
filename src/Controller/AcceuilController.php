<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
}
