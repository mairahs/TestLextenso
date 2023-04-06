<?php

namespace App\Controller;

use App\Service\DonneesService;
use App\Service\AppelsApiService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(AppelsApiService $appelApiService, DonneesService $donneesService): Response
    {
        $donneesApi = $appelApiService->recuperationDonneesApi(326094471);
        $donneesService->enregistrementDonnes($donneesApi);

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
}
