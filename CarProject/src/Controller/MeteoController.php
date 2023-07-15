<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MeteoController extends AbstractController
{
    /**
     * @Route("/meteo", name="meteo")
     */
    public function index(Request $request): Response
    {
        $apiKey = '6d0194f4f8e645cf9d9736827600cc86'; 
        $latitude = '48.8566'; // coordonnées de Paris, par exemple
        $longitude = '2.3522';
        $url = 'https://api.weatherbit.io/v2.0/current?lat='.$latitude.'&lon='.$longitude.'&key='.$apiKey;
        
        $response = HttpClient::create()->request('GET', $url);
        $data = $response->toArray();
        
        // Selon la documentation Weatherbit, les données de température peuvent être extraites comme suit:
        $temperature = $data['data'][0]['temp'];

        // check if the request is Ajax
        if ($request->isXmlHttpRequest()) {
            return new JsonResponse(['temperature' => $temperature]);
        }

        return $this->render('meteo/index.html.twig', [
            'temperature' => $temperature,
        ]);
    }
}
