<?php

namespace App\Service;

use App\Entity\Adresse;
use Psr\Log\LoggerInterface;
use App\Entity\Etablissement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class DonneesService
{
    private $gestionnaireEntites;
    private $log;
 
    public function __construct(EntityManagerInterface $gestionnaireEntites, LoggerInterface $log)
    {
        $this->gestionnaireEntites = $gestionnaireEntites;
        $this->log = $log;
    }

    public function enregistrementDonnes(array $donnees): bool
    {
       try {
            if (empty($donnees) || $donnees['header']['statut'] != Response::HTTP_OK) {
                throw new Exception("L'appel à l'API n'a remonté aucune données exploitables");
            }

            foreach ($donnees['etablissements'] as $item) {
                $etablissement = new Etablissement();

                $etablissement->setSiren($item['siren']);
                $etablissement->setSiret($item['siret']);
                $etablissement->setSiege($item['etablissementSiege']);
               
                
                $adresse = new Adresse();
                $adresse->setEtablissement($etablissement);
                $adresse->setSiret($etablissement->getSiret());
                $adresse->setSiege($etablissement->isSiege());
                $this->gestionnaireEntites->persist($adresse);

                $etablissement->addAdress($adresse);
                $this->gestionnaireEntites->persist($etablissement);
            }

            $this->gestionnaireEntites->flush();

            return true;
        
       } catch(Throwable $t) {
            $this->log->critical("Une erreur s'est produite lors de l'insertion en base de données ". $t->getMessage);
       }

       return false;
    }
}
