<?php

namespace App\Controller;

use App\Service\DonneesService;
use App\Form\RechercheSirenType;
use App\Service\AppelsApiService;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EtablissementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function accueil(
        AppelsApiService $appelApiService, 
        DonneesService $donneesService,
        Request $request
        ): Response
    {
        $formulaire = $this->createForm(RechercheSirenType::class);
        if ($formulaire->handleRequest($request) && $formulaire->isSubmitted() && $formulaire->isValid()) {
            $sirenRecherche = $formulaire->getData()['siren'];
            $donneesApi = $appelApiService->recuperationDonneesApi($sirenRecherche);
            $donneesService->enregistrementDonnes($donneesApi);

            return $this->redirectToRoute('app_index');
        }
       
        return $this->render('accueil/accueil.html.twig', [
            'formulaire' => $formulaire->createView()
        ]);
    }

    #[Route('/index', name: 'app_index')]
    public function index(EtablissementRepository $er): Response
    {
        $etablissements = $er->findAll();

        return $this->render('index/index.html.twig', [
            'etablissements' => $etablissements
        ]);
    }

    #[Route('/voirEtablissement/{id}', name: 'app_voir')]
    public function voir(int $id, EtablissementRepository  $er): Response
    {
        $etablissement = $er->find($id);
        $adresses = $etablissement->getAdresses()->toArray();
       
        return $this->render('voir/voir.html.twig', [
            'etablissement' => $etablissement,
            'adresses' => $adresses
        ]);
    }

    #[Route('/voirAdresse/{id}', name: 'app_voir_adresse')]
    public function voirAdresse(int $id, AdresseRepository  $ar): Response
    {
        $adresse = $ar->find($id);
     
        return $this->render('voir/voirAdresse.html.twig', [
            'adresse' => $adresse,
            'etablissement' => $adresse->getEtablissement()
        ]);
    }
}
