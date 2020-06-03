<?php

namespace App\Controller;

	use App\Entity\Chambres;

	use App\Repository\ChambresRepository;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Component\Serializer\Encoder\JsonEncoder;
	use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
	use Symfony\Component\Serializer\Serializer;



	class APIController extends AbstractController
	{
	    /**
	     * @Route("/api", name="liste_api", methods={"GET"})
	     */
	    public function liste(ChambresRepository $chambresRepo)
	    {
	        // On récupère la liste des articles
	        $chambres = $chambresRepo->FindAll();


	        // On spécifie qu'on utilise un encodeur en json
	        $encoders = [new JsonEncoder()];


	        // On instancie le "normaliseur" pour convertir la collection en tableau
	        $normalizers = [new ObjectNormalizer()];


	        // On fait la conversion en json
	        // On instancie le convertisseur
	        $serializer = new Serializer($normalizers, $encoders);


	        // On convertit en json
	        $jsonContent = $serializer->serialize($chambres, 'json', [
	            'circular_reference_handler' => function($object){
	                return $object->getId();
	            }
	        ]);


	        // On instancie la réponse
	        $response = new Response($jsonContent);


	        // On ajoute l'entête HTTP
	        $response->headers->set('Content-Type', 'application/json');


	        // On envoie la réponse
	        return $response;
	    }


	}
